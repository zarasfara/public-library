<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->sentence,
            'available' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(600, 400),
        ];
    }
}
