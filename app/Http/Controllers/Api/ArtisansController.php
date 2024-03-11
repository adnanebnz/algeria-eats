<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artisan;

class ArtisansController extends Controller
{
    public function index()
    {
        $artisans = Artisan::with(['user', 'products', 'reviews'])->get();

        return response()->json([
            'artisans' => $artisans,
        ]);
    }
}
