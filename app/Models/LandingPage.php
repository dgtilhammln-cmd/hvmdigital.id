<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'city_key', 'city_name', 'slug', 'hero_title', 'hero_subtitle',
        'content_intro', 'content_why_us', 'content_process', 'featured_image',
        'is_active', 'meta_title', 'meta_description', 'meta_keywords', 'og_image',
        'geo_region', 'geo_placename', 'geo_position', 'icbm',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getRouteKeyName(): string { return 'city_key'; }

    public function getCityConfig(): array
    {
        return config('cities.' . $this->city_key, []);
    }
}
