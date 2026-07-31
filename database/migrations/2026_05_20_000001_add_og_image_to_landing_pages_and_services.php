<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('landing_pages') && !Schema::hasColumn('landing_pages', 'og_image')) {
            Schema::table('landing_pages', function (Blueprint $table) {
                $table->string('og_image')->nullable()->after('meta_keywords');
            });
        }

        if (Schema::hasTable('services') && !Schema::hasColumn('services', 'og_image')) {
            Schema::table('services', function (Blueprint $table) {
                $table->string('og_image')->nullable()->after('meta_keywords');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('landing_pages') && Schema::hasColumn('landing_pages', 'og_image')) {
            Schema::table('landing_pages', function (Blueprint $table) {
                $table->dropColumn('og_image');
            });
        }

        if (Schema::hasTable('services') && Schema::hasColumn('services', 'og_image')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('og_image');
            });
        }
    }
};
