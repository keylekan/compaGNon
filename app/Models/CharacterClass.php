<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CharacterClass extends Model
{
    protected $fillable = [
        'character_id',
        'class_id',
        'level',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(PlayableClass::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(CharacterClassLevel::class)
            ->orderBy('level');
    }
}
