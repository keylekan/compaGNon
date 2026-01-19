<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(PlayableRace::class, 'race_id');
    }

    public function classes()
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
}
