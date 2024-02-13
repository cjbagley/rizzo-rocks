<?php

namespace Database\Factories;

use App\Enums\ImageType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'filepath' => fake()->filePath(),
            'alt' => fake()->name(),
            'type' => fake()->randomElement(ImageType::class)->value,
        ];
    }
}
