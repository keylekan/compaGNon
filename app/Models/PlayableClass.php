<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
