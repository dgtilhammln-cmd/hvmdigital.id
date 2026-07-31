<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Identitas Usaha
            $table->string('business_name');
            $table->string('slug')->unique(); // untuk hvmdigital.id/s/{slug}
            $table->string('business_type')->nullable();       // F&B, Fashion, Jasa, dll
            $table->string('business_category')->nullable();   // sub-kategori
            $table->text('description')->nullable();

            // Legalitas
            $table->string('nib')->nullable();                 // NIB / SIUP
            $table->string('npwp')->nullable();

            // Kontak & Lokasi
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email_business')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Media
            $table->string('logo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->json('gallery')->nullable();               // array of image paths

            // Sosial Media
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();

            // Langganan & Status
            $table->enum('plan', ['free', 'pro'])->default('free');
            $table->enum('status', ['onboarding', 'active', 'suspended'])->default('onboarding');
            $table->string('theme_slug')->default('starter');  // tema yang dipilih
            $table->json('selected_features')->nullable();     // fitur yang dipilih (auto-calc)
            $table->integer('onboarding_step')->default(1);    // step terakhir onboarding

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
