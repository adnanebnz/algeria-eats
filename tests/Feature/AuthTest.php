<?php

namespace Tests\Feature;

use App\Models\Artisan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_unauthenticated_users_cannot_access_artisan_dashboard(): void
    {
        $this->refreshDatabase();

        $response = $this->get('/artisan/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/auth/login');
    }

    public function test_authentificated_artisans_can_access_to_their_dashboards(): void
    {
        $user = User::create([
            'nom' => 'John',
            'prenom' => 'Doe',
            'adresse' => 'Alger',
            'wilaya' => 'Alger',
            'num_telephone' => '0555555555',
            'image' => 'image',
            'password' => bcrypt('password'),
            'email' => 'test@example.com',

        ]);
        Artisan::create([
            'user_id' => 1,
            'desc_entreprise' => 'Description',
            'heure_ouverture' => '08:00:00',
            'heure_fermeture' => '17:00:00',
            'rating' => 0,
            'type_service' => 'sucree',
        ]);

        $response = $this->actingAs($user)->get('/artisan/dashboard');

        $response->assertStatus(200);
    }

    public function test_login_redirects_to_home_page(): void
    {
        $this->refreshDatabase();

        $user = User::create([
            'nom' => 'John',
            'prenom' => 'Doe',
            'adresse' => 'Alger',
            'wilaya' => 'Alger',
            'num_telephone' => '0555555555',
            'image' => 'image',
            'password' => bcrypt('password'),
            'email' => 'test@example.com',
        ]);

        $this->post('/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/');
    }
}
