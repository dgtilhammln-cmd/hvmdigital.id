<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Portfolio extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'slug', 'client', 'category', 'description',
        'featured_image', 'featured_image_thumb', 'gallery',
        'url', 'city', 'is_active', 'sort_order',
    ];

    protected $casts = ['gallery' => 'array', 'is_active' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }
}
