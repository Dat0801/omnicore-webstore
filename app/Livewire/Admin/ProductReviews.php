<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductReview;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviews extends Component
{
    use WithPagination;

    public $search = '';

    public $onlyPending = false;

    public $productId = null;

    public function updating($property): void
    {
        if (in_array($property, ['search', 'onlyPending', 'productId'], true)) {
            $this->resetPage();
        }
    }

    public function toggleApproval(int $reviewId): void
    {
        $review = ProductReview::with('product')->findOrFail($reviewId);

        $review->is_approved = ! $review->is_approved;
        $review->save();

        if ($review->product instanceof Product) {
            $this->recalculateProductStats($review->product);
        }
    }

    public function deleteReview(int $reviewId): void
    {
        $review = ProductReview::with('product')->findOrFail($reviewId);
        $product = $review->product;

        $review->delete();

        if ($product instanceof Product) {
            $this->recalculateProductStats($product);
        }
    }

    public function render()
    {
        $query = ProductReview::with(['product', 'user'])->latest();

        if ($this->onlyPending) {
            $query->where('is_approved', false);
        }

        if ($this->productId !== null && $this->productId !== '') {
            $query->where('product_id', $this->productId);
        }

        if ($this->search !== '') {
            $search = '%'.$this->search.'%';

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                    ->orWhere('body', 'like', $search)
                    ->orWhereHas('product', function ($productQuery) use ($search) {
                        $productQuery->where('name', 'like', $search);
                    })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', $search)
                            ->orWhere('email', 'like', $search);
                    });
            });
        }

        return view('livewire.admin.product-reviews', [
            'reviews' => $query->paginate(20),
        ]);
    }

    protected function recalculateProductStats(Product $product): void
    {
        $stats = $product->approvedReviews()
            ->selectRaw('AVG(rating) as avg_rating, COUNT(*) as total_reviews')
            ->first();

        if ($stats !== null && $stats->total_reviews > 0) {
            $product->rating = round((float) $stats->avg_rating, 1);
            $product->reviews_count = (int) $stats->total_reviews;
        } else {
            $product->rating = 0;
            $product->reviews_count = 0;
        }

        $product->save();
    }
}
