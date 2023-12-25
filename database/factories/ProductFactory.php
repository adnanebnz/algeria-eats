<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artisan_id' => rand(1, 10),
            'nom' => $this->faker->name(),
            'description' => $this->faker->text(),
            'categorie' => 'sucree',
            'prix' => $this->faker->numberBetween(50, 500),
            'images' => [
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
            ],
            'rating' => $this->faker->numberBetween(0, 5),

        ];
    }
}
