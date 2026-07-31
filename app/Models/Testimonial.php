<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'company', 'city', 'city_key', 'photo', 'photo_thumb',
        'content', 'rating', 'service_used', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean', 'rating' => 'integer'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }
    public function scopeForCity($query, string $cityKey) { return $query->where('city_key', $cityKey); }
}
