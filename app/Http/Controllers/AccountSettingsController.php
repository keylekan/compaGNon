<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountSettingsController extends Controller
{
    public function edit(Request $request)
    {
        return view('account.settings', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2 Mo max
        ]);

        // Mise à jour du nom
        $user->name = $validated['name'];

        // Upload avatar (optionnel)
        if ($request->hasFile('avatar')) {
            // Supprimer l’ancien avatar si présent
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_path = $path;
        }

        $user->save();

        return redirect()
            ->route('account.settings')
            ->with('status', 'Paramètres mis à jour.');
    }
}
