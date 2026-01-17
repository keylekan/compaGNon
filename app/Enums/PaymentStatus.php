<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case UNKNOWN = 'unknown';
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case REFUNDED = 'refunded';
}
