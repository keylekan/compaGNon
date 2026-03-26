<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlayableRace extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'image_path',
        'hp_modifier',
        'points_c',
        'points_l',
        'points_v',
        'points_r'
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'skill_playable_race'
        )->withTimestamps();
    }
}
