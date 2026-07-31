<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'category', 'city_key', 'is_active', 'sort_order'];
    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }
    public function scopeForCity($query, ?string $cityKey) { return $query->where(fn($q) => $q->whereNull('city_key')->orWhere('city_key', $cityKey)); }
    public function scopeGeneral($query) { return $query->where('category', 'general'); }
}
