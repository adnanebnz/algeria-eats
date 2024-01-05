<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artisan;

class ArtisanController extends Controller
{
    public function index()
    {
        return response()->json([
            'artisans' => Artisan::with(['user', 'reviews', 'reviews.user', 'products'])->get(),
        ]);
    }

    public function show(Artisan $artisan)
    {
        return response()->json([
            'artisan' => $artisan->load(['user', 'reviews', 'reviews.user', 'products']),
        ]);
    }
}
