<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use App\Models\PlayableClass;
use App\Models\PlayableRace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        abort_unless($character->user_id === auth()->id(), 403);

        $character->load(['race', 'classes']);

        return view('characters.show', compact('character'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
