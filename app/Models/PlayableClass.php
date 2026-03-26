<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayableClass extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'image_path',
        'category',
        'allowed_alignments',
    ];

    protected $casts = [
        'allowed_alignments' => 'array',
    ];

    public function skillLevels(): HasMany
    {
        return $this->hasMany(SkillClassLevel::class);
    }

    public function levelBonuses(): HasMany
    {
        return $this->hasMany(ClassLevelBonus::class);
    }
}
