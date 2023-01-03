<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(300,300),
            'twitter' => $this->faker->url,
            'github' => $this->faker->url,
            'website' => $this->faker->url,
            'description' => $this->faker->paragraph,

        ];
    }
}
