<?php

namespace Database\Factories;

use App\Enums\GameCaptureType;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameCaptureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'type' => fake()->randomElement(GameCaptureType::class)->value,
            'filekey' => fake()->uuid(),
            'comments' => fake()->text(),
        ];
    }
}
