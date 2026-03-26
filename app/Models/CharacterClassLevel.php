<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterClassLevel extends Model
{
    protected $fillable = [
        'character_class_id',
        'level',
        'variant',
    ];

    public function characterClass(): BelongsTo
    {
        return $this->belongsTo(CharacterClass::class);
    }
}
