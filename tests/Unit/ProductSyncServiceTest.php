<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProductSyncServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_syncs_parent_and_variant_products_from_erp(): void
    {
        config(['services.erp.url' => 'http://test-erp.local/api']);

        Http::fake([
            'http://test-erp.local/api/products*' => Http::response([
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Parent Product',
                        'description' => 'Parent description',
                        'price' => 100.00,
                        'original_price' => 120.00,
                        'is_active' => true,
                        'variant_attributes' => null,
                        'has_variants' => true,
                        'rating' => 4.5,
                        'reviews_count' => 10,
                        'badge' => 'New',
                        'category' => [
                            'name' => 'Electronics',
                        ],
                        'images' => [
                            ['url' => 'http://example.com/image.jpg'],
                        ],
                        'variants' => [
                            [
                                'id' => 2,
                                'name' => 'Parent Product - Black',
                                'description' => 'Variant description',
                                'price' => 110.00,
                                'original_price' => 130.00,
                                'is_active' => true,
                                'variant_attributes' => [
                                    'color' => 'Black',
                                ],
                                'rating' => 4.8,
                                'reviews_count' => 5,
                                'badge' => 'Limited',
                            ],
                        ],
                    ],
                ],
                'links' => [
                    'next' => null,
                ],
            ], 200),
        ]);

        $service = app(ProductSyncService::class);
        $service->syncProducts();

        $this->assertSame(2, Product::count());

        $parent = Product::where('erp_product_id', '1')->firstOrFail();
        $this->assertNull($parent->erp_parent_id);
        $this->assertTrue($parent->has_variants);
        $this->assertSame('Parent Product', $parent->name);
        $this->assertSame('Electronics', $parent->category);
        $this->assertSame('http://example.com/image.jpg', $parent->image);

        $variant = Product::where('erp_product_id', '2')->firstOrFail();
        $this->assertSame('1', $variant->erp_parent_id);
        $this->assertFalse($variant->has_variants);
        $this->assertSame('Parent Product - Black', $variant->name);
        $this->assertSame(['color' => 'Black'], $variant->variant_attributes);
        $this->assertSame('http://example.com/image.jpg', $variant->image);
    }

    public function test_sync_does_not_override_webstore_publish_flag(): void
    {
        config(['services.erp.url' => 'http://test-erp.local/api']);

        Http::fake([
            'http://test-erp.local/api/products*' => Http::response([
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Parent Product',
                        'description' => 'Parent description',
                        'price' => 100.00,
                        'original_price' => 120.00,
                        'is_active' => true,
                        'variant_attributes' => null,
                        'has_variants' => false,
                        'rating' => 4.5,
                        'reviews_count' => 10,
                        'badge' => 'New',
                        'category' => [
                            'name' => 'Electronics',
                        ],
                        'images' => [
                            ['url' => 'http://example.com/image.jpg'],
                        ],
                        'variants' => [],
                    ],
                ],
                'links' => [
                    'next' => null,
                ],
            ], 200),
        ]);

        $service = app(ProductSyncService::class);

        // First sync: product is created using ERP data
        $service->syncProducts();

        $product = Product::where('erp_product_id', '1')->firstOrFail();

        // Admin publishes the product on webstore
        $product->update(['is_published' => true]);

        // Run sync again with same ERP payload
        $service->syncProducts();

        // Webstore publish flag must be preserved
        $this->assertTrue($product->fresh()->is_published);

        // Admin unpublishes the product
        $product->update(['is_published' => false]);

        // Sync once more
        $service->syncProducts();

        // Webstore unpublish decision must still be preserved
        $this->assertFalse($product->fresh()->is_published);
    }
}
