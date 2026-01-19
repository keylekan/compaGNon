<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case UNKNOWN = 'unknown';
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::UNKNOWN => 'Inconnu',
            self::UNPAID => 'Non payé',
            self::PAID => 'Payé',
            self::REFUNDED => 'Remboursé',
        };
    }
}
