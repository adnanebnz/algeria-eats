<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $artisan = $request->input('artisan');
            $artisanRating = $request->input('artisanRating');
            $productRating = $request->input('productRating');
            $productType = $request->input('productType');
            $orderDirection = $request->input('orderDirection', 'desc');

            $filters = compact('search', 'artisan', 'artisanRating', 'productRating', 'productType');

            return response()->json([
                'products' => Product::filters($filters)
                    ->with(['artisan.user', 'reviews'])
                    ->orderBy('prix', $orderDirection)
                    ->paginate(10),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(Product $product)
    {
        try {
            return response()->json([
                'product' => $product->with(['artisan.user', 'reviews', 'reviews.user'])->first(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getFeaturedProducts()
    {
        try {
            return response()->json([
                'products' => Product::where('rating', '>=', 3)->with(['artisan.user', 'reviews'])->limit(4)->get(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
