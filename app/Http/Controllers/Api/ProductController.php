<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'products' => Product::with(['artisan.user'])->get(),
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'product' => $product->with(['artisan.user', 'reviews', 'reviews.user'])->first(),
        ]);
    }

    public function getFeaturedProducts()
    {
        return response()->json([
            'products' => Product::where('rating', '>=', 3)->with(['artisan.user'])->get(),
        ]);
    }
}
