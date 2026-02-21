<?php

namespace App\Enums;

enum InviteStatus: string
{
    case INVITED = 'invited';
    case CONFIRMED = 'confirmed';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::INVITED => 'Invité',
            self::CONFIRMED => 'Inscrit',
            self::ACCEPTED => 'Accepté',
            self::REFUSED => 'Refusé',
            self::CANCELLED => 'Annulé',
        };
    }
}
