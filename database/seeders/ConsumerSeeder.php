<?php

namespace Database\Seeders;

use App\Models\Consumer;
use Illuminate\Database\Seeder;

class ConsumerSeeder extends Seeder
{
    public function run(): void
    {
        Consumer::factory(10)->create();
    }
}
