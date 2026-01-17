<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayableRace extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'image_path',
    ];
}
