<?php

namespace App\Actions;

use App\Enums\InviteStatus;
use App\Enums\PaymentStatus;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InviteUsersToEventAction
{
    /**
     * @param  array<int, string>  $emails
     * @param  array<string, mixed> $defaults Optionnels: payment_status, paid_at, etc.
     * @return array{created:int, updated:int, linked:int, skipped:int}
     */
    public function execute(Event $event, array $emails, array $defaults = []): array
    {
        $now = now();

        $emails = collect($emails)
            ->map(fn ($e) => Str::of($e)->trim()->lower()->toString())
            ->filter()
            ->unique()
            ->values();

        if ($emails->isEmpty()) {
            return ['created' => 0, 'updated' => 0, 'linked' => 0, 'skipped' => 0];
        }

        $usersByEmail = User::query()
            ->whereIn('email', $emails->all())
            ->get(['id', 'email'])
            ->keyBy('email');

        $stats = ['created' => 0, 'updated' => 0, 'linked' => 0, 'skipped' => 0];

        DB::transaction(function () use ($event, $emails, $usersByEmail, $defaults, $now, &$stats) {
            foreach ($emails as $email) {
                $user = $usersByEmail->get($email);

                $registration = EventRegistration::query()->firstOrNew([
                    'event_id' => $event->id,
                    'email' => $email,
                ]);

                $isNew = ! $registration->exists;

                if ($isNew) {
                    $registration->invite_status = InviteStatus::INVITED;
                    $registration->payment_status = PaymentStatus::UNKNOWN;
                    $registration->invited_at = $now;
                }

                // Defaults métier optionnels (ex: import "déjà payé")
                if (array_key_exists('payment_status', $defaults)) {
                    $registration->payment_status = $defaults['payment_status'];
                }
                if (array_key_exists('paid_at', $defaults)) {
                    $registration->paid_at = $defaults['paid_at'];
                }

                // Si user existe, rattacher immédiatement
                if ($user) {
                    if ($registration->user_id && $registration->user_id !== $user->id) {
                        $stats['skipped']++;
                        continue;
                    }

                    $registration->user_id = $user->id;
                    $registration->invite_status = InviteStatus::LINKED;
                    $registration->linked_at ??= $now;

                    $stats['linked']++;
                }

                $registration->save();

                $isNew ? $stats['created']++ : $stats['updated']++;
            }
        });

        return $stats;
    }
}
