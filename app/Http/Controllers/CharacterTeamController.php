<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CharacterTeamController extends Controller
{
    public function store(Request $request, Character $character)
    {
        // 🔒 à adapter selon ta logique (policy), ici on suppose : perso appartient au user
        abort_unless($character->user_id === auth()->id(), 403);

        if ($character->team_id) {
            return back()->with('error', 'Ce personnage est déjà dans une équipe.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:teams,name'],
            'bg'   => ['nullable', 'string', 'max:500'],
        ], [
            'name.unique' => 'Une équipe porte déjà ce nom.',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
            'bg'   => $validated['bg'] ?? null,
            'slug' => $this->generateUniqueTeamSlug($validated['name']),
        ]);

        $character->team()->associate($team);
        $character->save();

        return back()->with('success', 'Équipe créée et rejointe.');
    }

    public function join(Request $request, Character $character)
    {
        abort_unless($character->user_id === auth()->id(), 403);

        if ($character->team_id) {
            return back()->with('error', 'Ce personnage est déjà dans une équipe.');
        }

        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:120'],
        ]);

        $team = Team::query()->where('slug', $validated['slug'])->first();

        if (! $team) {
            return back()->withErrors(['slug' => 'Tag introuvable. Demandez-le à votre responsable d\'équipe.'])->withInput();
        }

        $character->team()->associate($team);
        $character->save();

        return back()->with('success', 'Équipe rejointe.');
    }

    public function leave(Character $character)
    {
        abort_unless($character->user_id === auth()->id(), 403);

        $character->team()->dissociate();
        $character->save();

        return back()->with('success', 'Vous avez quitté l’équipe.');
    }

    private function generateUniqueTeamSlug(string $name): string
    {
        $base = Str::slug($name);
        $base = $base !== '' ? $base : 'team';

        do {
            $suffix = Str::lower(Str::random(6)); // alphanum
            $slug = "{$base}-{$suffix}";
        } while (Team::query()->where('slug', $slug)->exists());

        return $slug;
    }
}
