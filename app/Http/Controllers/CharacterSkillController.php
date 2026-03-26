<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CharacterSkillController extends Controller
{
    public function store(Request $request, Character $character): RedirectResponse
    {
        Gate::authorize('update', $character);

        $data = $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
        ]);

        $character->loadMissing('skills');

        $skill = Skill::findOrFail($data['skill_id']);

        if ($character->skills->contains($skill->id)) {
            return back()->with('error', 'Cette compétence est déjà acquise.');
        }

        $totalBonuses = $character->total_bonuses;

        $spentPoints = [
            'points_c' => $character->skills->where('type', 'c')->sum('cost'),
            'points_l' => $character->skills->where('type', 'l')->sum('cost'),
            'points_v' => $character->skills->where('type', 'v')->sum('cost'),
            'points_r' => $character->skills->where('type', 'r')->sum('cost'),
        ];

        $availablePoints = [
            'points_c' => max(0, $totalBonuses->points_c - $spentPoints['points_c']),
            'points_l' => max(0, $totalBonuses->points_l - $spentPoints['points_l']),
            'points_v' => max(0, $totalBonuses->points_v - $spentPoints['points_v']),
            'points_r' => max(0, $totalBonuses->points_r - $spentPoints['points_r']),
        ];

        $pointKey = match ($skill->type) {
            'c' => 'points_c',
            'l' => 'points_l',
            'v' => 'points_v',
            'r' => 'points_r',
            default => null,
        };

        if (! $pointKey) {
            return back()->with('error', 'Type de compétence invalide.');
        }

        if (($availablePoints[$pointKey] ?? 0) < $skill->cost) {
            return back()->with('error', 'Points insuffisants pour acheter cette compétence.');
        }

        $character->skills()->attach($skill->id);

        return back()->with('success', 'Compétence achetée avec succès.');
    }
}
