<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();

            $table->string('domain');                                // contoh: tokobaju.com
            $table->string('tld');                                   // .com, .id, .co.id, dll
            $table->unsignedInteger('base_price')->default(0);       // harga asli domain (Rp)
            $table->unsignedInteger('sell_price')->default(0);       // harga jual (x2 + admin + PPN)
            $table->unsignedInteger('admin_fee')->default(10000);    // biaya admin Rp 10.000
            $table->unsignedInteger('tax_amount')->default(0);       // PPN 11%
            $table->unsignedInteger('total_price')->default(0);      // total bayar

            // Status pembayaran & domain
            $table->enum('payment_status', ['pending', 'paid', 'expired', 'refunded'])->default('pending');
            $table->enum('domain_status', ['checking', 'available', 'registered', 'active', 'failed'])->default('checking');
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('admin_notes')->nullable();                 // catatan admin saat beli manual

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_domains');
    }
};
