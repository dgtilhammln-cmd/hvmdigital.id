<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('megpreneur_participants', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_peserta', 20)->unique(); // MGP-0001
            $table->string('nama_pic');
            $table->string('nama_usaha');
            $table->string('kontak_pic')->unique(); // No WA - hanya boleh daftar sekali
            $table->string('bidang_sektor');
            $table->string('foto_follow_ig');   // path ke storage
            $table->string('foto_follow_tiktok'); // path ke storage
            $table->boolean('konfirmasi_maps')->default(false);
            $table->boolean('is_valid')->default(true);   // admin bisa invalidate
            $table->boolean('is_winner')->default(false); // ditentukan admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('megpreneur_participants');
    }
};
