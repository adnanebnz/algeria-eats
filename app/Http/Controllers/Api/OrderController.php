<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateInvoiceAndSendMail;
use App\Jobs\PurchaseJob;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json([
            'orders' => Order::where('buyer_id', auth()->user()->id)->with(['orderItems.product', 'artisan', 'delivery', 'delivery.deliveryMan'])->get(),
        ]);
    }

    public function show(Order $order)
    {
        return response()->json([
            'order' => $order->with(['orderItems.product', 'artisan', 'delivery', 'delivery.deliveryMan'])->first(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'artisan_id' => 'required|integer',
            'adresse' => 'required|string|max:255',
            'wilaya' => 'required|string|max:255',
            'daira' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'orderItems' => 'required|array',
            'orderItems.*.product_id' => 'required|integer',
            'orderItems.*.quantity' => 'required|integer',
        ]);

        $order = Order::create([
            'buyer_id' => auth()->user()->id,
            'artisan_id' => $data['artisan_id'],
            'adresse' => $data['adresse'],
            'wilaya' => $data['wilaya'],
            'daira' => $data['daira'],
            'commune' => $data['commune'],
            'status' => 'not_started',
        ]);

        foreach ($data['orderItems'] as $orderItem) {
            $product = Product::where('id', $orderItem['product_id'])->first();
            $order->orderItems()->create([
                'product_id' => $orderItem['product_id'],
                'quantity' => $orderItem['quantity'],
                'prix_total' => $orderItem['quantity'] * $product->prix,
            ]);
        }

        PurchaseJob::dispatch($order);
        GenerateInvoiceAndSendMail::dispatch($order);

        return response()->json([
            'order' => $order->with(['orderItems.product', 'artisan', 'delivery', 'delivery.deliveryman'])->first(),
        ]);
    }
}
