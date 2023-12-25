<?php

namespace Database\Seeders;

use App\Models\DeliveryMan;
use Illuminate\Database\Seeder;

class DeliveryManSeeder extends Seeder
{
    public function run(): void
    {

        DeliveryMan::factory(10)->create();
    }
}
