<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->unique()->word(),
            "alias" => fake()->unique()->slug(),
            "description" => implode(' ',fake()->paragraphs('2')),
            'image' => fake()->unique()->imageUrl(),
            'status' =>'1',
        ];
    }
}
