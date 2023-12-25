<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create([
            'nom' => 'Benzerdjeb',
            'prenom' => 'Adnane',
            'adresse' => 'Ain dheb makhokh mansourah',
            'wilaya' => 'Oran',
            'num_telephone' => '0512345678',
            'email' => 'skillzdev@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adnane2002'),
            'remember_token' => Str::random(10),
        ]);

        return [
            'user_id' => $user->id,
        ];
    }
}
