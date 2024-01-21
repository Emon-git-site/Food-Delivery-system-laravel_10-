<?php

namespace Database\Factories\backend;

use App\Models\backend\Category;
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
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'category_name' => $this->faker->word,
            'category_slug' => $this->faker->slug,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
