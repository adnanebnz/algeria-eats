<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreate;
use App\Http\Requests\ProductUpdate;
use App\Mail\FinishedOrder;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ArtisanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('artisan');
    }

    // PRODUCT SECTION
    protected function saveProduct(array $data, ?Product $product = null)
    {
        if (isset($data['images'])) {
            $uploadedFilesUrl = [];

            foreach ($data['images'] as $image) {
                $filename =
                    'image_'.
                    uniqid().
                    '.'.
                    $image->getClientOriginalExtension();
                Storage::disk('public')->put(
                    $filename,
                    file_get_contents($image->getRealPath())
                );
                $uploadedFilesUrl[] = Storage::disk('public')->url($filename);
            }
            $data['images'] = $uploadedFilesUrl;
        }

        $product = Product::updateOrCreate(['id' => $product?->id], $data);

        return response()->json(
            [
                'product' => $product,
            ]
        );
    }

    public function index()
    {
        $latestOrders = Order::where('artisan_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $monthlyOrderCounts = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as order_count')
        )
            ->where('artisan_id', auth()->user()->id)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Prepare data for the chart
        $months = $monthlyOrderCounts->pluck('month')->toArray();

        $orderCounts = $monthlyOrderCounts->pluck('order_count')->toArray();

        $totalProducts = Product::where(
            'artisan_id',
            auth()->user()->id
        )->count();

        $orders = Order::where('artisan_id', auth()->user()->id);

        $totalDeliveries = Delivery::whereHas('order', function ($query) {
            $query->where('artisan_id', auth()->user()->id);
        })->count();

        $totalIncomes = 0;
        foreach ($orders->get() as $order) {
            $totalIncomes += $order->getTotalPrice();
        }

        $totalOrders = $orders->count();

        $topSellingProducts = Product::where('artisan_id', auth()->user()->id)
            ->orderBy('rating', 'desc')
            ->take(5)
            ->get();

        $revenueBreakdown = Product::select(
            'categorie',
            DB::raw('SUM(prix) as total_revenue')
        )
            ->where('artisan_id', auth()->user()->id)
            ->groupBy('categorie')
            ->get();

        // Prepare data for the revenue breakdown bar chart
        $categories = $revenueBreakdown->pluck('categorie')->toArray();
        $customLabels = array_map(function ($category) {
            return $category === 'sucree' ? 'Sucrée' : 'Salée';
        }, $categories);
        $totalRevenueByCategory = $revenueBreakdown
            ->pluck('total_revenue')
            ->toArray();

        // prepare data for pie chart of the number of products by category
        $productsByCategory = Product::select(
            'categorie',
            DB::raw('COUNT(*) as product_count')
        )
            ->where('artisan_id', auth()->user()->id)
            ->groupBy('categorie')
            ->get();

        $productsCountByCategory = $productsByCategory
            ->pluck('product_count')
            ->toArray();

        $customCategoryLabels = array_map(function ($category) {
            return $category === 'sucree' ? 'Sucrée' : 'Salée';
        }, $categories);

        return response()->json(
            [
                'latestOrders' => $latestOrders,
                'months' => $months,
                'orderCounts' => $orderCounts,
                'totalOrders' => $totalOrders,
                'totalProducts' => $totalProducts,
                'totalDeliveries' => $totalDeliveries,
                'topSellingProducts' => $topSellingProducts,
                'totalIncomes' => $totalIncomes,
                'categories' => $categories,
                'totalRevenueByCategory' => $totalRevenueByCategory,
                'customLabels' => $customLabels,
                'productsCountByCategory' => $productsCountByCategory,
                'customCategoryLabels' => $customCategoryLabels,
            ]
        );
    }

    public function productsIndex(Request $request)
    {
        $query = Product::select(
            'id',
            'images',
            'nom',
            'prix',
            'categorie',
            'created_at'
        )->where('artisan_id', auth()->user()->id);

        // Filtering by search term
        if ($request->has('search')) {
            $query->where('nom', 'like', '%'.request('search').'%');
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

        $products = $query->paginate(10);

        return response()->json([
            'products' => $products,
        ]);
    }

    public function showProduct(Product $product)
    {
        return response()->json([
            'product' => $product,
        ]);
    }

    public function storeProduct(ProductCreate $request)
    {

        return $this->saveProduct($request->validated());
    }

    public function updateProduct(Product $product, ProductUpdate $request)
    {

        return $this->saveProduct($request->validated(), $product);
    }

    public function destroyProduct(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Deleted Product']);
    }
    // PRODUCT SECTION END

    // ORDERS SECTION

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
        )->where('artisan_id', auth()->user()->id);

        // Filtering by search term of buyer name
        if ($request->has('search')) {
            $query->whereHas('buyer', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%')
                    ->orWhereRaw(
                        "concat(nom, ' ', prenom) like '%".
                        request('search').
                        "%'"
                    )
                    ->orWhere('email', 'like', '%'.request('search').'%');
            });
        }

        // Filtering by status
        if ($request->has('status')) {
            $query->where('status', request('status'));
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

        $orders = $query->paginate(10);

        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function showOrder(Order $order)
    {
        $delivery = Delivery::where('order_id', $order->id)->first();

        return response()->json([
            'order' => $order,
            'delivery' => $delivery,
        ]);
    }

    public function updateOrder(Order $order, Request $request)
    {
        $data = $request->validate([
            'status' => 'required|in:not_started,processing,cancelled,completed',
        ]);
        if ($data['status'] == 'completed') {
            Mail::to($order->buyer->email)->send(new FinishedOrder($order));
        }
        $order->update([
            'status' => $data['status'],
        ]);

        return response()->json([
            'order' => $order,
        ]);
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Order Destroyed',
        ]);
    }

    // ORDERS SECTION END

    // DELIVERIES SECTION
    public function deliveriesIndex(Request $request)
    {
        $query = Delivery::select(
            'id',
            'order_id',
            'deliveryMan_id',
            'status',
            'created_at',
            'updated_at'
        )
            ->whereHas('order', function ($query) {
                $query->where('artisan_id', auth()->user()->id);
            })
            ->where('deliveryMan_id', '!=', null);

        // Filtering by search term of buyer name
        if ($request->has('search')) {
            $query->whereHas('order.buyer', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%')
                    ->orWhereRaw(
                        "concat(nom, ' ', prenom) like '%".
                        request('search').
                        "%'"
                    );
            });
        }

        // Filtering by status
        if ($request->has('status')) {
            $query->where('status', request('status'));
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

        $deliveries = $query->paginate(10);

        return response()->json([
            'deliveries' => $deliveries,
        ]);
    }

    public function showDelivery(Delivery $delivery)
    {
        return response()->json([
            'delivery' => $delivery,
        ]);
    }

    public function affectDelivery(Order $order)
    {
        $delivery = Delivery::where('order_id', $order->id)->first();
        if ($delivery) {

            return response()->json([
                'error' => 'Already affected',
            ]);
        } else {
            Delivery::create([
                'order_id' => $order->id,
                'status' => 'not_started',
            ]);
        }

        return response()->json([
            'message' => 'Delivery affected!',
        ]);
    }

    public function unaffectDelivery(Delivery $delivery)
    {
        $delivery->update([
            'deliveryMan_id' => null,
            'status' => 'not_started',
        ]);

        return response()->json(
            [
                'message' => 'Delivery unnaffected successfully',
            ]
        );
    }
    // DELIVERIES SECTION END
}
