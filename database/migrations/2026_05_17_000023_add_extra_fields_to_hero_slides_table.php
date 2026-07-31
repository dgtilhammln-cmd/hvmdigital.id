<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('avatar_1')->nullable();
            $table->string('avatar_2')->nullable();
            $table->string('avatar_3')->nullable();
            $table->string('rating_text')->nullable();
            $table->integer('stars')->default(5);
            $table->string('feature_1')->nullable();
            $table->string('feature_2')->nullable();
            $table->string('feature_3')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn([
                'avatar_1', 'avatar_2', 'avatar_3',
                'rating_text', 'stars',
                'feature_1', 'feature_2', 'feature_3'
            ]);
        });
    }
};
