<?php

namespace Tests\Feature;

use App\Livewire\Admin\ProductReviews as AdminProductReviews;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminProductReviewManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_reviews(): void
    {
        $response = $this->get(route('admin.reviews.index'));

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_see_admin_reviews_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.reviews.index'));

        $response->assertStatus(200);
        $response->assertSee('Admin Reviews');
        $response->assertSeeLivewire('admin.product-reviews');
    }

    public function test_admin_can_toggle_review_approval_and_update_product_stats(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'is_published' => true,
            'is_active_in_erp' => true,
            'rating' => 0,
            'reviews_count' => 0,
        ]);

        $review = ProductReview::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 4,
            'title' => 'Good product',
            'body' => 'Overall quite satisfied with the product quality.',
            'is_approved' => false,
        ]);

        $this->actingAs($user);

        Livewire::test(AdminProductReviews::class)
            ->call('toggleApproval', $review->id);

        $this->assertDatabaseHas('product_reviews', [
            'id' => $review->id,
            'is_approved' => true,
        ]);

        $product->refresh();

        $this->assertSame(4.0, (float) $product->rating);
        $this->assertSame(1, $product->reviews_count);

        Livewire::test(AdminProductReviews::class)
            ->call('toggleApproval', $review->id);

        $this->assertDatabaseHas('product_reviews', [
            'id' => $review->id,
            'is_approved' => false,
        ]);

        $product->refresh();

        $this->assertSame(0.0, (float) $product->rating);
        $this->assertSame(0, $product->reviews_count);
    }

    public function test_admin_can_delete_review_and_product_stats_are_recalculated(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'is_published' => true,
            'is_active_in_erp' => true,
            'rating' => 4.5,
            'reviews_count' => 2,
        ]);

        $review = ProductReview::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 5,
            'title' => 'Excellent',
            'body' => 'Very happy with this purchase.',
            'is_approved' => true,
        ]);

        $this->actingAs($user);

        Livewire::test(AdminProductReviews::class)
            ->call('deleteReview', $review->id);

        $this->assertDatabaseMissing('product_reviews', [
            'id' => $review->id,
        ]);

        $product->refresh();

        $this->assertSame(0.0, (float) $product->rating);
        $this->assertSame(0, $product->reviews_count);
    }
}
