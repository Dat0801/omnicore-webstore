<?php

namespace Tests\Feature;

use App\Livewire\ProductDetail;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_submit_review_for_product(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'is_published' => true,
            'is_active_in_erp' => true,
            'rating' => 0,
            'reviews_count' => 0,
        ]);

        $this->actingAs($user);

        Livewire::test(ProductDetail::class, ['product' => $product])
            ->set('reviewRating', 5)
            ->set('reviewTitle', 'Very satisfied')
            ->set('reviewBody', 'The product works very well, stable quality and worth the price.')
            ->call('submitReview');

        $this->assertDatabaseHas('product_reviews', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 5,
            'title' => 'Very satisfied',
        ]);

        $product->refresh();

        $this->assertSame(5.0, (float) $product->rating);
        $this->assertSame(1, $product->reviews_count);
    }

    public function test_product_detail_recalculates_stats_for_existing_reviews(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'is_published' => true,
            'is_active_in_erp' => true,
            'rating' => 0,
            'reviews_count' => 0,
        ]);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 4,
            'title' => 'Good product',
            'body' => 'Overall quite satisfied with the product quality.',
            'is_approved' => true,
        ]);

        Livewire::test(ProductDetail::class, ['product' => $product]);

        $product->refresh();

        $this->assertSame(4.0, (float) $product->rating);
        $this->assertSame(1, $product->reviews_count);
    }
}
