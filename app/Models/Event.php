<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'starts_at', 'ends_at', 'type', 'is_published',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_published' => 'boolean',
        'type' => \App\Enums\EventType::class,
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
