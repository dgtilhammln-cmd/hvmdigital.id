<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'headline',
        'subheadline',
        'button_text',
        'button_link',
        'image',
        'order',
        'is_active',
        'avatar_1',
        'avatar_2',
        'avatar_3',
        'rating_text',
        'stars',
        'feature_1',
        'feature_2',
        'feature_3',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
