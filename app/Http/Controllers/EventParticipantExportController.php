<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventParticipantExportController extends Controller
{
    public function __invoke(Request $request, Event $event): StreamedResponse
    {
        if (! $request->user()?->admin) {
            abort(403);
        }

        $event->load([
            'registrations.user',
            'registrations.character',
            'registrations.character.race',
            'registrations.character.classes',
            'registrations.character.god',
            'registrations.character.team',
            'registrations.character.skills',
        ]);

        $filename = sprintf(
            'event-%s-participants-%s.csv',
            $event->id,
            now()->format('Y-m-d')
        );

        return response()->streamDownload(function () use ($event) {
            $handle = fopen('php://output', 'w');

            // BOM UTF-8 pour Excel
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'email',
                'nom_joueur',
                'age_joueur',
                'nom_perso',
                'genre',
                'race',
                'classes',
                'dieu',
                'alignement',
                'groupe',
                'pv',
                'points_total',
                'points_restants',
                'dons',
                'competences',
                'description',
            ], ';');

            foreach ($event->registrations as $registration) {
                fputcsv($handle, [
                    $registration->email ?? '',
                    $registration->user?->name ?? '- Invité -',
                    $registration->user?->age ?? '-',
                    $registration->character?->name ?? '-',
                    $registration->character?->gender ?? '-',
                    $registration->character?->race->title ?? '-',
                    $this->formatClasses($registration->character),
                    $registration->character?->god->name ?? '-',
                    $registration->character?->alignment ?? '-',
                    $registration->character?->team?->name ?? '-',
                    $registration->character?->total_bonuses['hit_points'] ?? '-',
                    $this->formatPoints($registration->character?->total_bonuses),
                    $this->formatPoints($registration->character?->available_points),
                    $this->formatSkills($registration->character, true),
                    $this->formatSkills($registration->character, false),
                    $registration->character?->player_notes ?? '-',
                ], ';');
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function formatSkills(?Character $character, bool $isFeat): string
    {
        if (! $character) {
            return '-';
        }

        $skills = $character->skills
            ->filter(fn ($skill) => $skill->is_feat === $isFeat)
            ->groupBy('id')
            ->map(function ($skillPurchases) {
                $skill = $skillPurchases->first();
                $quantity = $skillPurchases->sum(fn ($skill) => $skill->pivot->quantity ?? 1);

                return "{$skill->title} x{$quantity}";
            })
            ->values();

        return $skills->isEmpty() ? '-' : $skills->implode(', ');
    }

    private function formatClasses(?Character $character): string
    {
        if (! $character || $character->classes->isEmpty()) {
            return '-';
        }

        return $character->classes
            ->map(fn ($class) => "{$class->title} niv. {$class->pivot->level}")
            ->implode(', ');
    }

    private function formatPoints(?array $points): string
    {
        if (! $points) {
            return '-';
        }

        return collect([
            'C' => $points['points_c'] ?? $points['c'] ?? 0,
            'L' => $points['points_l'] ?? $points['l'] ?? 0,
            'V' => $points['points_v'] ?? $points['v'] ?? 0,
            'V1' => $points['points_r'] ?? $points['r'] ?? 0,
        ])
            ->map(fn ($value, $label) => "{$value}{$label}")
            ->implode(', ');
    }
}
