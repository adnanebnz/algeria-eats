<?php

namespace Database\Seeders;

use App\Models\Artisan;
use Illuminate\Database\Seeder;

class ArtisanSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::factory(10)->create();
    }
}
