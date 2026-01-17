<?php

namespace App\Models;

use App\Enums\InviteStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id', 'email', 'user_id', 'character_id', 'token',
        'invite_status', 'payment_status',
        'invited_at', 'linked_at', 'confirmed_at', 'paid_at',
    ];

    protected $casts = [
        'invite_status' => InviteStatus::class,
        'payment_status' => PaymentStatus::class,
        'invited_at' => 'datetime',
        'linked_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
