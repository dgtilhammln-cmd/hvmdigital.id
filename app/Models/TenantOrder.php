<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantOrder extends Model
{
    protected $fillable = [
        'tenant_id',
        'invoice_number',
        'total_amount',
        'domain_name',
        'domain_price',
        'features',
        'snap_token',
        'payment_status',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
