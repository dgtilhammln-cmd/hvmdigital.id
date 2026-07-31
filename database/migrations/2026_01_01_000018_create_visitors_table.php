<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('page_url');
            $table->string('page_title')->nullable();
            $table->string('referer')->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('device_type', ['mobile', 'tablet', 'desktop'])->nullable();
            $table->string('browser')->nullable();
            $table->string('country', 10)->nullable();
            $table->string('city')->nullable();
            $table->timestamps();

            $table->index('created_at');
            $table->index('page_url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
