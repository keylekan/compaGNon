<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['name', 'slug', 'bg'];

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
}
