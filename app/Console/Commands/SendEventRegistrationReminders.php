<?php

namespace App\Console\Commands;

use App\Enums\InviteStatus;
use App\Mail\EventRegistrationReminderMail;
use App\Models\EventRegistration;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class SendEventRegistrationReminders extends Command
{
    protected $signature = 'mail:registration-reminders {--dry-run : N’envoie pas, affiche juste}';
    protected $description = 'Envoie les relances aux participants dont l’inscription à un événement n’est pas finalisée (character null).';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $registrations = EventRegistration::query()
            ->with(['event'])
            ->whereNull('character_id')
            ->whereNot('invite_status', InviteStatus::CANCELLED)
            ->where(function (Builder $query) {
                $query->whereNull('reminder_sent_at')
                    ->orWhereDate('reminder_sent_at', '<=', now()->subDays(15));
            })
            ->whereHas('event', fn ($q) => (
                $q
                    ->whereDate('starts_at', '>=', now()->toDateString())
                    ->where('is_published', true)
            ))
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('Aucune relance à envoyer.');
            return self::SUCCESS;
        }

        $this->info("Relances à traiter : {$registrations->count()}");

        foreach ($registrations as $registration) {
            $event = $registration->event;

            // adapte selon ton modèle: user email / invited_email, etc.
            $to = $registration->email;

            if ($dryRun) {
                $this->line("[DRY] Enverrait à {$to} pour event #{$event->id} ({$event->title})");
                continue;
            }

            Mail::to($to)->send(new EventRegistrationReminderMail(
                event: $event,
                registration: $registration,
                isReminder: !is_null($registration->reminder_sent_at),
            ));

            $registration->forceFill([
                'reminder_sent_at' => now(),
            ])->save();

            $this->line("Envoyé à {$to} (registration #{$registration->id})");
        }

        return self::SUCCESS;
    }
}
