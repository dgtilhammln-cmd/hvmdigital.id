<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('city_key')->nullable(); // for filtering
            $table->string('photo')->nullable();
            $table->string('photo_thumb')->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('rating')->default(5); // 1-5
            $table->string('service_used')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
