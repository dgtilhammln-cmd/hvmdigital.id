<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('internships')) {
            Schema::table('internships', function (Blueprint $table) {
                if (!Schema::hasColumn('internships', 'custom_link')) {
                    $table->string('custom_link')->nullable()->after('jobdesc');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->dropColumn('custom_link');
        });
    }
};
