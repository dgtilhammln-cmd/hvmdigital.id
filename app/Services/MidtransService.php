<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use Exception;

class MidtransService
{
    /**
     * Generate Snap Token from Midtrans API
     *
     * @param array $transactionDetails ['order_id' => '...', 'gross_amount' => 150000]
     * @param array $customerDetails ['first_name' => '...', 'email' => '...', 'phone' => '...']
     * @param array $itemDetails [['id' => '...', 'price' => 150000, 'quantity' => 1, 'name' => '...']]
     * @return string|null Snap Token
     */
    public function getSnapToken(array $transactionDetails, array $customerDetails = [], array $itemDetails = [])
    {
        $serverKey = Setting::where('key', 'midtrans_server_key')->value('value');
        $isProduction = Setting::where('key', 'midtrans_is_production')->value('value') === '1';

        if (empty($serverKey)) {
            throw new Exception("Midtrans Server Key is not configured.");
        }

        $baseUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => $transactionDetails,
        ];

        if (!empty($customerDetails)) {
            $payload['customer_details'] = $customerDetails;
        }

        if (!empty($itemDetails)) {
            $payload['item_details'] = $itemDetails;
        }

        $response = Http::withBasicAuth($serverKey, '')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl, $payload);

        if ($response->successful()) {
            return $response->json('token');
        }

        throw new Exception('Midtrans Error: ' . $response->body());
    }
}
