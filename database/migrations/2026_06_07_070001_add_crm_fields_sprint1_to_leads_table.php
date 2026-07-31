<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('leads', function (Blueprint $table) {
            $table->enum('status', ['new', 'contacted', 'proposal', 'closing', 'won', 'lost'])
                  ->default('new')->after('source_url');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['status', 'notes']);
        });
    }
};
