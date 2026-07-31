<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = [
        'user_id', 'business_name', 'slug', 'business_type', 'business_category',
        'description', 'nib', 'npwp', 'phone', 'whatsapp', 'email_business',
        'address', 'city', 'province', 'postal_code', 'latitude', 'longitude',
        'logo', 'cover_photo', 'gallery', 'instagram', 'facebook', 'tiktok', 'youtube',
        'plan', 'status', 'theme_slug', 'selected_features', 'onboarding_step',
    ];

    protected function casts(): array
    {
        return [
            'gallery'           => 'array',
            'selected_features' => 'array',
            'latitude'          => 'decimal:7',
            'longitude'         => 'decimal:7',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function domains(): HasMany
    {
        return $this->hasMany(TenantDomain::class);
    }

    public function activeDomain()
    {
        return $this->domains()->where('domain_status', 'active')->first();
    }

    public function isPro(): bool
    {
        return $this->plan === 'pro';
    }

    public function publicUrl(): string
    {
        $active = $this->activeDomain();
        if ($active) {
            return 'https://' . $active->domain;
        }
        return url('/s/' . $this->slug);
    }
}
