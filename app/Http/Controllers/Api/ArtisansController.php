<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class ArtisansController extends Controller
{
    public function index()
    {
        $artisans = Artisan::with(['user', 'products', 'reviews'])->get();

        return response()->json([
            'artisans' => $artisans,
        ]);
    }

    public function setOrderStatus(Request $request, Order $order)
    {
        try {
            $data = $request->validate([
                'status' => 'required|string|in:pending,accepted,declined,delivered,completed',
            ]);

            if ($data['status'] == 'completed') {
                $deviceKeys = $order->buyer->deviceKeys->toArray();
                $deviceKeys = array_column($deviceKeys, 'fcm_key');
                foreach ($deviceKeys as $deviceKey) {
                    NotificationsController::notify('Order Complete', 'Your order has been completed', $deviceKey);
                }
            }

            $order->status = $data['status'];
            $order->save();

            return response()->json([
                'message' => 'Order status updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}
