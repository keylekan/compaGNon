<?php

namespace App\Enums;

enum EventType: string
{
    case GN = 'gn';
    case SOIREE = 'soiree';
    case AUTRE = 'autre';

    public function label(): string
    {
        return match ($this) {
            self::GN => 'GN',
            self::SOIREE => 'Soirée',
            self::AUTRE => 'Autre',
        };
    }
}
