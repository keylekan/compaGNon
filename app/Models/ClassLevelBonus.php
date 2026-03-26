<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassLevelBonus extends Model
{
    protected $fillable = [
        'playable_class_id',
        'level',
        'xp_needed',
        'hit_points',
        'points_c',
        'points_l',
        'points_v',
        'points_r',
    ];

    protected $casts = [
        'level' => 'integer',
        'xp_needed' => 'integer',
        'hit_points' => 'integer',
        'points_c' => 'integer',
        'points_l' => 'integer',
        'points_v' => 'integer',
        'points_r' => 'integer',
    ];

    public function playableClass(): BelongsTo
    {
        return $this->belongsTo(PlayableClass::class);
    }
}
