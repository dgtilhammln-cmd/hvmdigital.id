<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        $keys = [
            // WhoisJSON API for domain checking
            ['group' => 'payment', 'key' => 'whoisjson_api_key', 'value' => '', 'type' => 'text', 'label' => 'WhoisJSON API Key (Cek Domain)'],

            // Midtrans Payment Gateway
            ['group' => 'payment', 'key' => 'midtrans_server_key',  'value' => '', 'type' => 'text', 'label' => 'Midtrans Server Key'],
            ['group' => 'payment', 'key' => 'midtrans_client_key',  'value' => '', 'type' => 'text', 'label' => 'Midtrans Client Key'],
            ['group' => 'payment', 'key' => 'midtrans_merchant_id', 'value' => '', 'type' => 'text', 'label' => 'Midtrans Merchant ID'],
            ['group' => 'payment', 'key' => 'midtrans_environment', 'value' => 'sandbox', 'type' => 'text', 'label' => 'Midtrans Environment (sandbox / production)'],
        ];

        foreach ($keys as $k) {
            Setting::firstOrCreate(
                ['key' => $k['key']],
                $k
            );
        }
    }

    public function down(): void
    {
        Setting::whereIn('key', [
            'whoisjson_api_key',
            'midtrans_server_key',
            'midtrans_client_key',
            'midtrans_merchant_id',
            'midtrans_environment',
        ])->delete();
    }
};
