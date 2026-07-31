<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantDomain extends Model
{
    protected $fillable = [
        'tenant_id', 'domain', 'tld', 'base_price', 'sell_price',
        'admin_fee', 'tax_amount', 'total_price', 'payment_status',
        'domain_status', 'midtrans_order_id', 'midtrans_snap_token',
        'paid_at', 'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Hitung harga jual (markup x2 + admin + PPN 11%)
     */
    public static function calculatePricing(int $basePrice): array
    {
        $sellPrice  = $basePrice * 2;
        $adminFee   = 10000;
        $subtotal   = $sellPrice + $adminFee;
        $taxAmount  = (int) round($subtotal * 0.11);
        $totalPrice = $subtotal + $taxAmount;

        return [
            'base_price'  => $basePrice,
            'sell_price'  => $sellPrice,
            'admin_fee'   => $adminFee,
            'tax_amount'  => $taxAmount,
            'total_price' => $totalPrice,
        ];
    }
}
