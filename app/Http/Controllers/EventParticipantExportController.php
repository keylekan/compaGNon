<?php

namespace App\Http\Controllers;

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
                'Nom du joueur',
                'Âge du joueur',
                'Nom du perso',
                'Genre',
                'Race',
                'Classe(s)',
                'Dieu',
                'Alignement',
                'Groupe',
            ], ';');

            foreach ($event->registrations as $registration) {
                fputcsv($handle, [
                    $registration->user?->name ?? '',
                    $registration->user?->age ?? '',
                    $registration->character?->name ?? '',
                    $registration->character?->gender ?? '',
                    $registration->character?->race->title ?? '',
                    $registration->character?->classes->pluck('title')->implode(', ') ?? '',
                    $registration->character?->god->name ?? '',
                    $registration->character?->alignment ?? '',
                    $registration->character?->team?->name ?? '',
                ], ';');
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
