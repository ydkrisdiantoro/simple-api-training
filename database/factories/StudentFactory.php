<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'year_in' => $this->faker->numberBetween(2020, 2024),
        ];
    }
}
