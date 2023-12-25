<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artisan>
 */
class ArtisanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'desc_entreprise' => fake()->paragraph,
            'heure_ouverture' => '08:00:00',
            'heure_fermeture' => '18:00:00',
            'rating' => 0,
            'type_service' => 'sucree',
        ];
    }
}
