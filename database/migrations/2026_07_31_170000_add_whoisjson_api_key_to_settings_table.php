<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure whoisjson_api_key exists (may have been missed in prior migration)
        Setting::firstOrCreate(
            ['key' => 'whoisjson_api_key'],
            ['group' => 'payment', 'value' => '', 'type' => 'text', 'label' => 'WhoisJSON API Key (Cek Domain)']
        );
    }

    public function down(): void
    {
        Setting::where('key', 'whoisjson_api_key')->delete();
    }
};
