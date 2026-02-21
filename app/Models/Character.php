<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'alignment',
        'race_id',
        'god_id',
        'player_notes',
    ];

    public function getAlignmentLabelAttribute(): string
    {
        if ($this->alignment === 'NN') {
            return 'Neutre';
        }

        $law = [
            'L' => 'Loyal',
            'N' => 'Neutre',
            'C' => 'Chaotique',
        ];

        $mor = [
            'B' => 'Bon',
            'N' => 'Neutre',
            'M' => 'Mauvais',
        ];

        $l = $this->alignment[0] ?? null;
        $m = $this->alignment[1] ?? null;

        if (!isset($law[$l], $mor[$m])) {
            return $this->alignment; // fallback brut
        }

        return "{$law[$l]} {$mor[$m]}";
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(PlayableRace::class, 'race_id');
    }

    public function god(): BelongsTo
    {
        return $this->belongsTo(\App\Models\God::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            PlayableClass::class,
            'character_classes',
            'character_id',
            'class_id'
        )
            ->withPivot('level')
            ->withTimestamps();
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }
}
