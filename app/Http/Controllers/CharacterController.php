<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use App\Models\Event;
use App\Models\God;
use App\Models\PlayableClass;
use App\Models\PlayableRace;
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
                'god_id'   => $data['god_id'],
            ]);

            // 2) Première classe (niveau 1)
            $character->classes()->attach($data['playable_class_id']);

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

        return view('characters.show', compact('character', 'nextPendingEvent'));
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
