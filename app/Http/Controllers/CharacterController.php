<?php

namespace App\Http\Controllers;

use App\Actions\LevelUpCharacterClass;
use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use App\Models\Event;
use App\Models\God;
use App\Models\PlayableClass;
use App\Models\PlayableRace;
use App\Models\Skill;
use App\Models\SkillPlayableRace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = auth()->user()->characters()
            ->with(['race', 'classes'])
            ->latest()
            ->get();

        return view('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('characters.create', [
            'races' => PlayableRace::orderBy('title')->get(),
            'classesByCategory' => PlayableClass::orderBy('title')->get()->groupBy('category'),
            'gods' => God::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(StoreCharacterRequest $request, LevelUpCharacterClass $levelUpCharacterClass)
    {
        $user = $request->user();
        $data = $request->validated();
        $playableClassId = $data['playable_class_id'];

        $character = DB::transaction(function () use ($data, $playableClassId, $user) {

            // 1) Créer le personnage
            $character = Character::create([
                'user_id'   => $user->id,
                'name'      => $data['name'],
                'gender'    => $data['gender'],
                'alignment' => $data['alignment'],
                'race_id'   => $data['race_id'],
                'god_id'    => $data['god_id'],
            ]);

            // 2) Créer sa première classe
            $characterClass = $character->characterClasses()->create([
                'class_id' => $playableClassId,
                'level' => 0,
            ]);

            // 3) Enregistrer le niveau 0
            $characterClass->levels()->create([
                'level' => 0,
                'variant' => 'default',
            ]);

            // 4) Enregistrer les skills de race
            $skillsToGrant = SkillPlayableRace::query()
                ->with('skill')
                ->where('playable_race_id', $data['race_id'])
                ->get();

            foreach ($skillsToGrant as $skillToGrant) {
                $character->skills()->attach($skillToGrant->skill_id, [
                    'purchased_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $character;
        });

        // 4) Passer le niveau 1
        $levelUpCharacterClass->execute($character, $playableClassId);

        return redirect()
            ->route('characters.show', $character)
            ->with('status', 'Personnage créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        $user = auth()->user();

        abort_unless($user->admin || $character->user_id === $user->id, 403);

        $character->load(['race', 'classes']);
        $character->load(['team.characters' => function ($q) {
            $q->orderBy('name');
        }]);

        $nextPendingEvent = Event::query()
            ->whereHas('registrations', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->whereNotIn('invite_status', ['confirmed', 'accepted', 'cancelled']);
            })
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->first();

        $availablePoints = $character->available_points;

        $availableSkills = Skill::query()
            ->withAvailablePointCost()
            ->availableForCharacter($character)
            ->orderBy('title')
            ->get();

        return view('characters.show', compact('character', 'nextPendingEvent', 'availablePoints', 'availableSkills'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        $request->validate([
            'player_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $character->update([
            'player_notes' => filled($request->player_notes) ? trim($request->player_notes) : null,
        ]);

        return back()->with('success', 'Mise à jour effectuée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        Gate::authorize('delete', $character);

        $character->delete();

        return redirect()
            ->route('characters.index')
            ->with('success', "Le personnage a bien été supprimé.");
    }
}
