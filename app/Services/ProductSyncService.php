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
        $allErpIds = [];
        $url = "{$this->erpBaseUrl}/products";

        do {
            // 1. Fetch from ERP
            $response = Http::withToken($this->erpApiKey)->get($url);

            if ($response->failed()) {
                Log::error('Failed to fetch products from ERP', ['status' => $response->status(), 'url' => $url]);
                throw new \Exception("Failed to fetch products from ERP: " . $response->status());
            }

            $json = $response->json();
            $erpProducts = $json['data'] ?? []; // Handle potential missing data key

            foreach ($erpProducts as $erpProduct) {
                // 2. Update or Create Snapshot
                Product::updateOrCreate(
                    ['erp_product_id' => $erpProduct['id']], // Match by ERP ID
                    [
                        'name' => $erpProduct['name'],
                        'description' => $erpProduct['description'] ?? null,
                        'price' => $erpProduct['price'],
                        'image' => $erpProduct['image_url'] ?? null,
                        'is_active_in_erp' => $erpProduct['is_active'] ?? true,
                        'is_published' => true,
                    ]
                );
                $allErpIds[] = $erpProduct['id'];
            }

            // Handle Pagination (Standard Laravel)
            $url = $json['links']['next'] ?? null;

        } while ($url);

        // 3. Handle Deactivation (Drift Prevention)
        // Any product locally that was NOT in the full ERP fetch should be marked inactive.
        if (!empty($allErpIds)) {
            Product::whereNotIn('erp_product_id', $allErpIds)
                ->update(['is_active_in_erp' => false]);
        }
    }
}
