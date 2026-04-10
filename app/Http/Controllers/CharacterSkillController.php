<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CharacterSkillController extends Controller
{
    public function store(Request $request, Character $character): RedirectResponse
    {
        Gate::authorize('update', $character);

        $data = $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'payment' => ['required', 'array'],
            'payment.C' => ['nullable', 'integer', 'min:0'],
            'payment.L' => ['nullable', 'integer', 'min:0'],
            'payment.V' => ['nullable', 'integer', 'min:0'],
            'payment.R' => ['nullable', 'integer', 'min:0'],
        ]);

        $payment = array_merge([
            'C' => 0,
            'L' => 0,
            'V' => 0,
            'R' => 0,
        ], $data['payment']);

        $character->loadMissing('skills');

        $skill = Skill::findOrFail($data['skill_id']);

        $currentPurchases = $character->skills()
            ->where('skills.id', $skill->id)
            ->count();
        if ($skill->max_purchases && $currentPurchases >= $skill->max_purchases) {
            return back()->with('skill-error', 'Cette compétence a atteint son maximum.')->withFragment('skills');
        }

        $availablePoints = $character->available_points;

        if (
            $payment['C'] > $availablePoints['c']
            || $payment['L'] > $availablePoints['l']
            || $payment['V'] > $availablePoints['v']
            || $payment['R'] > $availablePoints['r']
        ) {
            return back()->with('skill-error', 'Points insuffisants pour acheter cette compétence.')->withFragment('skills');
        }

        $character->skills()->attach($skill->id, [
            'quantity' => $data['quantity'],
            'cost_paid_c' => $payment['C'],
            'cost_paid_l' => $payment['L'],
            'cost_paid_v' => $payment['V'],
            'cost_paid_r' => $payment['R'],
            'purchased_at' => now(),
        ]);

        return back()->with('skill-success', 'Compétence achetée avec succès.')->withFragment('skills');
    }

    public function destroy(Character $character, Skill $skill): RedirectResponse
    {
        abort_unless($character->user_id === auth()->id(), 403);

        $lastPurchase = DB::table('character_skill')
            ->where('character_id', $character->id)
            ->where('skill_id', $skill->id)
            ->where('locked', false)
            ->orderByDesc('purchased_at')
            ->orderByDesc('id')
            ->first();

        if (! $lastPurchase) {
            return back()->with('skill-error', 'Cette compétence est verrouillée.')->withFragment('skills');
        }

        DB::table('character_skill')
            ->where('id', $lastPurchase->id)
            ->delete();

        return back()->with('skill-success', 'Un niveau de compétence a été retiré.')->withFragment('skills');
    }
}
