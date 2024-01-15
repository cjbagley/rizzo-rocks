<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'igdb_id' => fake()->randomNumber(1, 10000),
            'igdb_cover_id' => fake()->word(),
            'igdb_url' => fake()->url(),
            'played_years' => fake()->words(3, true),
            'comments' => fake()->text(),
        ];
    }
}
