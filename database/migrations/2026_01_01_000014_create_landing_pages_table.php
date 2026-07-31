<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('city_key')->unique(); // surabaya, jakarta, etc.
            $table->string('city_name');
            $table->string('slug')->unique();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle', 500)->nullable();
            $table->longText('content_intro')->nullable();
            $table->longText('content_why_us')->nullable();
            $table->longText('content_process')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_active')->default(true);
            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('geo_region')->nullable();
            $table->string('geo_placename')->nullable();
            $table->string('geo_position')->nullable();
            $table->string('icbm')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
