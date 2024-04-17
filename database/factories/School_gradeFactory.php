<?php

namespace Database\Factories;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class School_gradeFactory extends Factory
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
            'student_id' => Student::factory(),
            'japanese' => $this->faker->numberBetween($min = 0, $max = 100),
            'math' => $this->faker->numberBetween($min = 0, $max = 100),
            'science' => $this->faker->numberBetween($min = 0, $max = 100),
            'social_studies' => $this->faker->numberBetween($min = 0, $max = 100),
            'music' => $this->faker->numberBetween($min = 0, $max = 100),
            'home_economics' => $this->faker->numberBetween($min = 0, $max = 100),
            'english' => $this->faker->numberBetween($min = 0, $max = 100),
            'art' => $this->faker->numberBetween($min = 0, $max = 100),
            'health_and_physical_education' => $this->faker->numberBetween($min = 0, $max = 100),
        ];
    }
}
