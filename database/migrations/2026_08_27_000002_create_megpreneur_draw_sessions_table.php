<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('megpreneur_draw_sessions', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['draft', 'locked', 'announced'])->default('draft');
            $table->boolean('is_public')->default(false);  // apakah halaman publik aktif
            $table->boolean('draw_started')->default(false); // trigger dari admin untuk remote start animasi
            $table->json('winner_ids')->nullable();         // array of participant IDs
            $table->timestamp('drawn_at')->nullable();
            $table->string('drawn_by')->nullable();         // nama admin yang trigger
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('megpreneur_draw_sessions');
    }
};
