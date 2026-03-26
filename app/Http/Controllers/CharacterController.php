<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use App\Models\Event;
use App\Models\God;
use App\Models\PlayableClass;
use App\Models\PlayableRace;
use App\Models\Skill;
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
    public function store(StoreCharacterRequest $request)
    {
        $user = $request->user();

        $character = DB::transaction(function () use ($request, $user) {
            $data = $request->validated();

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
                'class_id' => $data['playable_class_id'],
                'level' => 1,
            ]);

            // 3) Enregistrer les niveaux 0 et 1
            $characterClass->levels()->createMany([
                [
                    'level' => 0,
                    'variant' => 'default',
                ],
                [
                    'level' => 1,
                    'variant' => 'default',
                ],
            ]);

            return $character;
        });

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

        $totalBonuses = $character->total_bonuses;

        $spentPoints = [
            'points_c' => $character->skills->sum('cost_c'),
            'points_l' => $character->skills->sum('cost_l'),
            'points_v' => $character->skills->sum('cost_v'),
            'points_r' => $character->skills->sum('cost_r'),
        ];

        $availablePoints = [
            'points_c' => max(0, $totalBonuses['points_c'] - $spentPoints['points_c']),
            'points_l' => max(0, $totalBonuses['points_l'] - $spentPoints['points_l']),
            'points_v' => max(0, $totalBonuses['points_v'] - $spentPoints['points_v']),
            'points_r' => max(0, $totalBonuses['points_r'] - $spentPoints['points_r']),
        ];

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
