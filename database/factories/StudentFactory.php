<?php

namespace Database\Factories;
use App\Models\School_grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'grade' => $this->faker->numberBetween($min = 1, $max = 4),
            'name' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'img_path' => 'https://picsum.photos/200/300',
            'comment' => $this->faker->realText(50),
        ];
    }
}
