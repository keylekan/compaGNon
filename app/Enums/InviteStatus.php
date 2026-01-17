<?php

namespace App\Enums;

enum InviteStatus: string
{
    case INVITED = 'invited';
    case LINKED = 'linked';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
}
