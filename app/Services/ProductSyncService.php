<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductSyncService
{
    protected string $erpBaseUrl;
    protected string $erpApiKey;

    public function __construct()
    {
        // Ideally from config
        $this->erpBaseUrl = config('services.erp.url', 'http://omnicore-erp.local/api');
        $this->erpApiKey = config('services.erp.key', 'secret');
    }

    public function syncProducts(): void
    {
        // 1. Fetch from ERP
        $response = Http::withToken($this->erpApiKey)
            ->get("{$this->erpBaseUrl}/products");

        if ($response->failed()) {
            Log::error('Failed to fetch products from ERP', ['status' => $response->status()]);
            return;
        }

        $erpProducts = $response->json('data'); // Assuming standard resource collection

        foreach ($erpProducts as $erpProduct) {
            // 2. Update or Create Snapshot
            // We do NOT modify local-only fields like 'is_published' unless desired (here we don't)
            Product::updateOrCreate(
                ['erp_product_id' => $erpProduct['id']], // Match by ERP ID
                [
                    'name' => $erpProduct['name'],
                    'price' => $erpProduct['price'],
                    'image' => $erpProduct['image_url'] ?? null,
                ]
            );
        }
    }
}
