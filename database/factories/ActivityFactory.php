<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'start_date' => $this->faker->dateTimeBetween('+5 days', '+10 days'),
            'end_date' => $this->faker->dateTimeBetween('+15 days', '+20 days'),
            'price' => $this->faker->randomFloat(2, 1, 10),
            'ranking' => $this->faker->numberBetween(1, 5),
        ];
    }
}
