<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalPendingOrders = Order::where('buyer_id', auth()->user()->id)
            ->where('status', 'not_started')
            ->orWhere('status', 'processing')
            ->count();

        $orders = Order::where('buyer_id', auth()->user()->id);
        $latestOrders = $orders
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $totalSpent = 0;
        foreach ($orders as $order) {
            $totalSpent += $order->total;
        }

        return view('user.dashboard', [
            'orders' => $orders,
            'totalOrders' => $orders->count(),
            'totalSpent' => $totalSpent,
            'totalPendingOrders' => $totalPendingOrders,
            'latestOrders' => $latestOrders,
        ]);
    }

    public function ordersIndex(Request $request)
    {
        $query = Order::select(
            'id',
            'status',
            'created_at',
            'buyer_id',
            'artisan_id',
            'adresse',
            'wilaya',
            'daira',
            'commune'
        )->where('buyer_id', auth()->user()->id);
        // Filtering by search term of artisan name
        if ($request->has('search')) {
            $query->whereHas('artisan', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%');
            });
        }

        // Filtering by date

        if ($request->has('date')) {
            $date = $request->input('date');
            if ($date == 'nouveau') {
                $query->orderBy('created_at', 'desc');
            } elseif ($date == 'ancien') {
                $query->orderBy('created_at', 'asc');
            }
        }

        // Filtering by status

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status == 'not_started') {
                $query->where('status', 'not_started');
            } elseif ($status == 'processing') {
                $query->where('status', 'processing');
            } elseif ($status == 'cancelled') {
                $query->where('status', 'cancelled');
            } elseif ($status == 'completed') {
                $query->where('status', 'completed');
            }
        }

        $orders = $query->paginate(10);

        return view('user.orders.order', [
            'orders' => $orders,
        ]);
    }

    public function showOrder(Order $order)
    {
        $delivery = Delivery::where('order_id', $order->id)->first();

        return view('user.orders.show', [
            'order' => $order,
            'delivery' => $delivery,
        ]);
    }

    public function cancelOrder(Order $order)
    {
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back();
    }

    public function showDelivery(Delivery $delivery)
    {
        return view('user.deliveries.show', [
            'delivery' => $delivery,
        ]);
    }
}
