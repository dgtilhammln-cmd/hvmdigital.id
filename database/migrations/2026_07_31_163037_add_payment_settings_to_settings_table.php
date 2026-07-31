<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $keys = [
            ['group' => 'payment', 'key' => 'midtrans_server_key', 'value' => '', 'type' => 'text', 'label' => 'Midtrans Server Key'],
            ['group' => 'payment', 'key' => 'midtrans_client_key', 'value' => '', 'type' => 'text', 'label' => 'Midtrans Client Key'],
            ['group' => 'payment', 'key' => 'midtrans_merchant_id', 'value' => '', 'type' => 'text', 'label' => 'Midtrans Merchant ID'],
            ['group' => 'payment', 'key' => 'midtrans_environment', 'value' => 'sandbox', 'type' => 'text', 'label' => 'Environment (sandbox / production)'],
        ];
        
        foreach ($keys as $k) {
            if (!Setting::where('key', $k['key'])->exists()) {
                Setting::create($k);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Setting::where('group', 'payment')->delete();
    }
};
