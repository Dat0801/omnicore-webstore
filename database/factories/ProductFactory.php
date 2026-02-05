<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'erp_product_id' => $this->faker->numberBetween(1000, 9999),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image' => null,
            'is_active_in_erp' => true,
            'is_published' => true,
        ];
    }
}
