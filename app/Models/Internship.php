<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'division',
        'location',
        'duration',
        'qualifications',
        'jobdesc',
        'custom_link',
        'is_active',
        'sort_order',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
                
                // Ensure unique slug
                $originalSlug = $model->slug;
                $count = 1;
                while (static::where('slug', $model->slug)->exists()) {
                    $model->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
        
        static::updating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
                
                $originalSlug = $model->slug;
                $count = 1;
                while (static::where('slug', $model->slug)->where('id', '!=', $model->id)->exists()) {
                    $model->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
    }
}
