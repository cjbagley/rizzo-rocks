<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tag' => $this->faker->word(),
            'code' => substr($this->faker->word(), 0, 3),
            'is_sensitive' => $this->faker->boolean(10),
            'colour' => $this->faker->hexColor(),
        ];
    }
}
