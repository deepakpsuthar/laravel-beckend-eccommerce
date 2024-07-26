<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>User::factory(),
            'category_id' => Category::factory(),
            'name' => fake()->unique()->word(),
            'alias' => fake()->unique()->slug(),
            'short_desc' => implode(' ',fake()->paragraphs('2')),
            'desc' => implode(' ',fake()->paragraphs('6')),
            'price' => fake()->randomNumber(3),
            'image' => fake()->unique()->imageUrl(),
            'status' =>'1',
        ];
    }
}
