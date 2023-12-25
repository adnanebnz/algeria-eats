<?php

namespace Tests\Feature;

use App\Models\Artisan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_contains_products(): void
    {
        $this->refreshDatabase();

        $user = User::create([
            'id' => 1,
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
            'user_id' => $user->id,
            'desc_entreprise' => 'Description',
            'heure_ouverture' => '08:00:00',
            'heure_fermeture' => '17:00:00',
            'rating' => 0,
            'type_service' => 'sucree',
        ]);

        $product = Product::create([
            'artisan_id' => $user->id,
            'nom' => 'Produit 1',
            'categorie' => 'sucree',
            'description' => 'Description',
            'prix' => 100,
            'description' => 'Description',
            'images' => 'image',
        ]);

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);

        $response->assertSee($product->nom);
    }
}
