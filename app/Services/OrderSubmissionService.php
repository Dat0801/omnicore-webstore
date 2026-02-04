<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderSubmissionService
{
    protected string $erpBaseUrl;
    protected string $erpApiKey;

    public function __construct()
    {
        $this->erpBaseUrl = config('services.erp.url', 'http://omnicore-erp.local/api');
        $this->erpApiKey = config('services.erp.key', 'secret');
    }

    public function submitOrder(Order $order): bool
    {
        // 1. Prepare Payload
        $payload = [
            'external_id' => $order->id,
            'customer_email' => $order->customer_email,
            'customer_name' => $order->customer_name,
            'total_amount' => $order->total_amount,
            'items' => $order->items->map(function ($item) {
                return [
                    'product_id' => $item->erp_product_id, // Send ERP ID back
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            })->toArray(),
        ];

        // 2. Post to ERP
        $response = Http::withToken($this->erpApiKey)
            ->post("{$this->erpBaseUrl}/orders", $payload);

        if ($response->successful()) {
            // 3. Update Status
            $erpOrderId = $response->json('id');
            $order->update([
                'status' => 'sent_to_erp',
                'erp_order_id' => $erpOrderId,
            ]);
            return true;
        } else {
            Log::error('Failed to submit order to ERP', ['order_id' => $order->id, 'response' => $response->body()]);
            $order->update(['status' => 'failed']);
            return false;
        }
    }
}
