<?php

namespace App\Http\Controllers;

use App\Enums\InviteStatus;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function confirm(Request $request, Event $event)
    {
        $data = $request->validate([
            'character_id' => ['required', 'integer', 'exists:characters,id'],
        ]);

        // Récupère l'inscription de l'utilisateur pour cet event (adapte au nom réel)
        $registration = $event->registrations()
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        // Vérifie que le personnage appartient à l'utilisateur
        $ownsCharacter = $request->user()->characters()->whereKey($data['character_id'])->exists();
        abort_unless($ownsCharacter, 403);

        // Associe le personnage + confirme
        $registration->character_id = $data['character_id'];
        $registration->invite_status = InviteStatus::CONFIRMED; // adapte au champ réel (inviteValue, etc.)
        $registration->save();

        return back()->with('success', 'Inscription réussie.');
    }

    public function accept(Request $request, EventRegistration $eventRegistration)
    {
        if (! $request->user()?->admin) {
            abort(403);
        }

        $eventRegistration->invite_status = InviteStatus::ACCEPTED;
        $eventRegistration->save();

        return back()->with('success', 'Inscription acceptée.');
    }

    public function refuse(Request $request, EventRegistration $eventRegistration)
    {
        if (! $request->user()?->admin) {
            abort(403);
        }

        $eventRegistration->invite_status = InviteStatus::REFUSED;
        $eventRegistration->save();

        return back()->with('success', 'Inscription refusée.');
    }
}
