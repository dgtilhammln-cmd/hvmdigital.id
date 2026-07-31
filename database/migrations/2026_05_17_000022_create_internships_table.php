<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Posisi
            $table->string('slug')->unique();
            $table->string('division'); // Nama Divisi
            $table->string('location'); // Lokasi
            $table->string('duration'); // Durasi internship
            $table->text('qualifications'); // Kualifikasi (HTML/List)
            $table->text('jobdesc'); // Jobdesk (HTML/List)
            $table->string('custom_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // Meta untuk SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
