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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Posisi
            $table->string('slug')->unique();
            $table->string('division'); // Nama Divisi
            $table->string('location'); // Lokasi
            $table->string('duration'); // Tipe Pekerjaan (Full-time, Contract, dll)
            $table->text('qualifications'); // Kualifikasi (HTML/List)
            $table->text('jobdesc'); // Jobdesk (HTML/List)
            $table->string('custom_link')->nullable(); // Custom URL for Apply
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // Meta untuk SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
