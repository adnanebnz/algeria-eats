<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryManController extends Controller
{
    public function getDeliveries(Request $request)
    {
        $deliveries = Delivery::where(
            'deliveryMan_id',
            $request->input('user_id')
        )->get();
        $deliveries->load(['order', 'order.buyer', 'order.artisan.user']);

        return response()->json([
            'deliveries' => $deliveries,
        ]);
    }
}
