<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // daftar kategori
        $categories = [
            'registration',
            'exams',
            'books',
            'items',
            'programs',
        ];

        return [
            'name' => fake()->words(3, true),   // contoh: "Basic Learning Book"
            'description' => fake()->sentence(8),
            'category' => fake()->randomElement($categories),
            'price' => fake()->numberBetween(15000, 350000),
        ];
    }
}
