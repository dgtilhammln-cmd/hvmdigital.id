<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lead_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color', 7)->default('#6366f1'); // hex color
            $table->timestamps();
        });

        Schema::create('lead_tag', function (Blueprint $table) {
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('lead_tag_id')->constrained('lead_tags')->onDelete('cascade');
            $table->primary(['lead_id', 'lead_tag_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('lead_tag');
        Schema::dropIfExists('lead_tags');
    }
};
