<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image', 'featured_image_thumb',
        'category', 'article_category_id', 'tags', 'status', 'published_at', 'views',
        'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'faqs'
    ];

    public function articleCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ArticleCategory::class, 'article_category_id');
    }

    protected $casts = [
        'tags'         => 'array',
        'faqs'         => 'array',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return $model->slug ?: $model->title;
            })
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->title . ' | HVM Digital';
    }

    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?: ($this->excerpt ?: '');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
