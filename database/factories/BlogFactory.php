<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'name' => $this->faker->realText(10),
            'img_path' => '',
            'price' => $this->faker->numberBetween($min = 50, $max = 999),
            'stock' => $this->faker->randomDigit,
            'comment' => $this->faker->realText(50),
            'company_id' => Brand::factory(),
        ];
    }
}
