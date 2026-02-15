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
                throw new \Exception('Failed to fetch products from ERP: '.$response->status());
            }

            $json = $response->json();
            $erpProducts = $json['data'] ?? []; // Handle potential missing data key

            foreach ($erpProducts as $erpProduct) {
                $parentImage = null;
                if (! empty($erpProduct['images']) && is_array($erpProduct['images'])) {
                    $firstImage = $erpProduct['images'][0] ?? null;
                    if (is_array($firstImage) && isset($firstImage['url'])) {
                        $parentImage = $firstImage['url'];
                    }
                }

                $parent = Product::updateOrCreate(
                    ['erp_product_id' => (string) $erpProduct['id']], // Match by ERP ID
                    [
                        'name' => $erpProduct['name'],
                        'description' => $erpProduct['description'] ?? null,
                        'price' => $erpProduct['price'],
                        'original_price' => $erpProduct['original_price'] ?? null,
                        'image' => $parentImage,
                        'category' => $erpProduct['category']['name'] ?? null,
                        'rating' => $erpProduct['rating'] ?? 0,
                        'reviews_count' => $erpProduct['reviews_count'] ?? 0,
                        'badge' => $erpProduct['badge'] ?? null,
                        'is_active_in_erp' => $erpProduct['is_active'] ?? true,
                        'has_variants' => ! empty($erpProduct['variants'] ?? []),
                        'variant_attributes' => $erpProduct['variant_attributes'] ?? null,
                        'erp_parent_id' => null,
                    ]
                );

                $allErpIds[] = (string) $erpProduct['id'];

                $variants = $erpProduct['variants'] ?? [];

                foreach ($variants as $variant) {
                    $variantId = (string) ($variant['id'] ?? null);

                    if (! $variantId) {
                        continue;
                    }

                    Product::updateOrCreate(
                        ['erp_product_id' => $variantId],
                        [
                            'name' => $variant['name'] ?? $parent->name,
                            'description' => $variant['description'] ?? $parent->description,
                            'price' => $variant['price'] ?? $parent->price,
                            'original_price' => $variant['original_price'] ?? $parent->original_price,
                            'image' => $parentImage,
                            'category' => $parent->category,
                            'rating' => $variant['rating'] ?? $parent->rating,
                            'reviews_count' => $variant['reviews_count'] ?? $parent->reviews_count,
                            'badge' => $variant['badge'] ?? $parent->badge,
                            'is_active_in_erp' => $variant['is_active'] ?? true,
                            'has_variants' => false,
                            'variant_attributes' => $variant['variant_attributes'] ?? [],
                            'erp_parent_id' => (string) $erpProduct['id'],
                        ]
                    );

                    $allErpIds[] = $variantId;
                }
            }

            // Handle Pagination (Standard Laravel)
            $url = $json['links']['next'] ?? null;

        } while ($url);

        // 3. Handle Deactivation (Drift Prevention)
        // Any product locally that was NOT in the full ERP fetch should be marked inactive.
        if (! empty($allErpIds)) {
            Product::whereNotIn('erp_product_id', $allErpIds)
                ->update(['is_active_in_erp' => false]);
        }
    }
}
