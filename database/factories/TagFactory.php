<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tag' => $this->faker->word(),
            'is_sensitive' => $this->faker->boolean(),
            'colour' => $this->faker->hexColor(),
        ];
    }
}
