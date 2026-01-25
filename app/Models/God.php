<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class God extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'icon_path',
        'allowed_believer_alignments',
        'allowed_cleric_alignments',
    ];

    protected $casts = [
        'allowed_believer_alignments' => 'array',
        'allowed_cleric_alignments' => 'array',
    ];
}
