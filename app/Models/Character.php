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

    public function characterClasses(): HasMany
    {
        return $this->hasMany(CharacterClass::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'character_skill')
            ->withPivot([
                'cost_paid_c',
                'cost_paid_l',
                'cost_paid_v',
                'cost_paid_r',
                'purchased_at',
            ])
            ->withTimestamps();
    }

    public function getTotalBonusesAttribute(): array
    {
        $this->loadMissing(
            'race',
            'characterClasses.levels',
            'characterClasses.class.levelBonuses'
        );

        $classBonuses = $this->characterClasses->flatMap(function ($characterClass) {
            $selectedLevels = $characterClass->levels
                ->keyBy(fn ($level) => $level->level . ':' . $level->variant);

            return $characterClass->class->levelBonuses
                ->filter(fn ($bonus) => $selectedLevels->has($bonus->level . ':' . $bonus->variant));
        });

        $race = $this->race;

        return [
            'hit_points' => $classBonuses->sum('hit_points') + ($race?->hp_modifier ?? 0),
            'points_c'   => $classBonuses->sum('points_c') + ($race?->points_c ?? 0),
            'points_l'   => $classBonuses->sum('points_l') + ($race?->points_l ?? 0),
            'points_v'   => $classBonuses->sum('points_v') + ($race?->points_v ?? 0),
            'points_r'   => $classBonuses->sum('points_r') + ($race?->points_r ?? 0),
        ];
    }
}
