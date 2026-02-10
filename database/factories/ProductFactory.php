<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Electronics', 'Home & Office', 'Wearables', 'Accessories'];
        $badges = [null, null, null, 'New Arrival', 'Sale -20%', 'Premium'];

        $price = $this->faker->randomFloat(2, 50, 500);
        $badge = $this->faker->randomElement($badges);
        $originalPrice = null;
        if ($badge && str_contains($badge, 'Sale')) {
            $originalPrice = $price * 1.25;
        }

        return [
            'erp_product_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $price,
            'original_price' => $originalPrice,
            'category' => $this->faker->randomElement($categories),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'reviews_count' => $this->faker->numberBetween(10, 500),
            'badge' => $badge,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop', // Placeholder image
            'is_active_in_erp' => true,
            'is_published' => true,
        ];
    }
}
