<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cost_c',
        'cost_l',
        'cost_v',
        'cost_r',
        'max_purchases',
    ];

    protected $casts = [
        'cost_c' => 'integer',
        'cost_l' => 'integer',
        'cost_v' => 'integer',
        'cost_r' => 'integer',
        'max_purchases' => 'integer',
    ];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_skill')
            ->withPivot([
                'cost_paid_c',
                'cost_paid_l',
                'cost_paid_v',
                'cost_paid_r',
                'purchased_at',
            ])
            ->withTimestamps();
    }

    public function races(): BelongsToMany
    {
        return $this->belongsToMany(
            PlayableRace::class,
            'skill_playable_race'
        )->withTimestamps();
    }

    public function classLevels(): HasMany
    {
        return $this->hasMany(SkillClassLevel::class);
    }

    public function scopeWithAvailablePointCost($query)
    {
        return $query->where(function ($query) {
            $query->whereNotNull('cost_c')
                ->orWhereNotNull('cost_l')
                ->orWhereNotNull('cost_v')
                ->orWhereNotNull('cost_r');
        });
    }

    public function scopeAvailableForCharacter(Builder $query, Character $character): Builder
    {
        return $query->where(function (Builder $query) use ($character) {
            $query->whereNull('max_purchases')
                ->orWhereRaw(
                    '(
                    SELECT COUNT(*)
                    FROM character_skill
                    WHERE character_skill.skill_id = skills.id
                      AND character_skill.character_id = ?
                ) < skills.max_purchases',
                    [$character->id]
                );
        });
    }
}
