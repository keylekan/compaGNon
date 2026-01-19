<?php

namespace App\Enums;

enum InviteStatus: string
{
    case INVITED = 'invited';
    case LINKED = 'linked';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::INVITED => 'Invité',
            self::LINKED => 'Compte créé',
            self::CONFIRMED => 'Participation confirmée',
            self::CANCELLED => 'Annulé',
        };
    }
}
