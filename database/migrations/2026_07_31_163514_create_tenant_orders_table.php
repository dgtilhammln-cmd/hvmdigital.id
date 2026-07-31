<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('total_amount', 12, 2);
            
            // Domain Details
            $table->string('domain_name')->nullable();
            $table->decimal('domain_price', 12, 2)->nullable();
            
            // Add-ons / Features (JSON array of selected feature IDs)
            $table->json('features')->nullable();
            
            // Payment Gateway info
            $table->string('snap_token')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, failed, expired
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_orders');
    }
};
