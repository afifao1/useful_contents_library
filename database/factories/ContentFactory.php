<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'url'         => $this->faker->url(),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
