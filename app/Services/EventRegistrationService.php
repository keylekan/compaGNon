<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class EventRegistrationService
{
    /**
     * Retourne la liste paginée des inscriptions d'un événement, filtrable.
     */
    public function paginatedForEvent(Event $event, Request $request, int $perPage = 15): LengthAwarePaginator
    {
        $search = trim((string) $request->string('q'));
        $inviteStatus = $request->string('invite_status')->toString();
        $paymentStatus = $request->string('payment_status')->toString();

        return EventRegistration::query()
            ->where('event_id', $event->id)
            ->with([
                'user',
                'character',
                'character.team',
                'character.race',
                'character.classes',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('character', fn ($c) => $c->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('character.team', fn ($t) => $t->where('name', 'like', "%{$search}%"))
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($inviteStatus !== '', fn ($q) => $q->where('invite_status', $inviteStatus))
            ->when($paymentStatus !== '', fn ($q) => $q->where('payment_status', $paymentStatus))
            ->orderByRaw('CASE WHEN user_id IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('invited_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Pratique pour réinjecter les filtres dans le composant.
     */
    public function filtersFrom(Request $request): array
    {
        return [
            'q' => trim((string) $request->string('q')),
            'invite_status' => $request->string('invite_status')->toString(),
            'payment_status' => $request->string('payment_status')->toString(),
        ];
    }
}
