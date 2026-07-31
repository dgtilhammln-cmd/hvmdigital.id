<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('image_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('path');
            $table->string('thumb_path')->nullable();
            $table->string('url');
            $table->string('thumb_url')->nullable();
            $table->unsignedInteger('size_kb')->nullable();
            $table->string('disk')->default('public');
            $table->string('uploadable_type')->nullable(); // morphable
            $table->unsignedBigInteger('uploadable_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_uploads');
    }
};
