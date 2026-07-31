<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('leads', function (Blueprint $table) {
            $table->timestamp('followup_at')->nullable()->after('assigned_to');
            $table->timestamp('last_contacted_at')->nullable()->after('followup_at');
        });
    }

    public function down(): void {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['followup_at', 'last_contacted_at']);
        });
    }
};
