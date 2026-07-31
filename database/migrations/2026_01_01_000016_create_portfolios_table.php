<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('category')->nullable(); // website, ecommerce, app, etc
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_thumb')->nullable();
            $table->json('gallery')->nullable(); // array of image paths
            $table->string('url')->nullable(); // live project URL
            $table->string('city')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
