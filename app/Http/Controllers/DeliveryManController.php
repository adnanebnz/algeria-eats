<?php

namespace App\Http\Controllers;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Jobs\AcceptedDeliveryJob;
use App\Mail\DeliveredPackage;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveryManController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('deliveryMan');
    }

    public function index()
    {
        $userId = auth()->user()->id;

        $latestDeliveries = Delivery::where('status', 'delivered')
            ->where('deliveryMan_id', $userId)
            ->latest('created_at')
            ->paginate(6);

        $completedDeliveriesToday = Delivery::where('status', 'delivered')
            ->where('deliveryMan_id', $userId)
            ->whereBetween('updated_at', [
                now()->startOfDay(),
                now()->endOfDay(),
            ])
            ->count();

        $uncompletedDeliveriesToday = Delivery::where('status', 'delivering')
            ->where('deliveryMan_id', $userId)
            ->whereBetween('updated_at', [
                now()->startOfDay(),
                now()->endOfDay(),
            ])
            ->count();

        $completedDeliveriesThisWeek = Delivery::where('status', 'delivered')
            ->where('deliveryMan_id', $userId)
            ->whereBetween('updated_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])
            ->count();

        $completedDeliveriesThisMonth = Delivery::where('status', 'delivered')
            ->where('deliveryMan_id', $userId)
            ->whereBetween('updated_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->count();

        $deliveriesPerMonth = [];

        $deliveries = Delivery::where('status', 'delivered')
            ->where('deliveryMan_id', $userId)
            ->get();

        foreach ($deliveries as $delivery) {
            $monthYearKey = Carbon::parse($delivery->updated_at)->isoFormat(
                'MMMM YYYY'
            );
            $deliveriesPerMonth[$monthYearKey] = isset(
                $deliveriesPerMonth[$monthYearKey]
            )
                ? $deliveriesPerMonth[$monthYearKey] + 1
                : 1;
        }

        $latestNotAcceptedDeliveries = Delivery::where('status', 'not_started')
            ->where('deliveryMan_id', $userId)
            ->latest('created_at')
            ->take(5);

        return view('deliveryMan.dashboard', [
            'deliveries' => $latestDeliveries,
            'countday' => $completedDeliveriesToday,
            'countweek' => $completedDeliveriesThisWeek,
            'countmonth' => $completedDeliveriesThisMonth,
            'uncompleted' => $uncompletedDeliveriesToday,
            'deliveriesPerMonth' => $deliveriesPerMonth,
            'latestNotAcceptedDeliveries' => $latestNotAcceptedDeliveries,
        ])->with(
            'i',
            ($latestDeliveries->currentPage() - 1) *
                $latestDeliveries->perPage()
        );
    }

    public function deliveriesIndex(Request $request)
    {
        $query = Delivery::select(
            'id',
            'status',
            'created_at',
            'updated_at',
            'order_id',
            'deliveryMan_id'
        )->whereNot('status', 'delivered');

        // FILTERING BY ARTISAN NAME
        if ($request->has('search')) {
            $query->whereHas('order.artisan', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%')
                    ->orWhere(
                        'num_telephone',
                        'like',
                        '%'.request('search').'%'
                    )
                    ->orWhere('email', 'like', '%'.request('search').'%')
                    ->orWhereRaw(
                        "CONCAT(nom, ' ', prenom) LIKE ?",
                        '%'.request('search').'%'
                    );
            });
        }

        // FILTER BY STATUS
        if ($request->filled('status')) {
            $query->where('status', request('status'));
        }

        // FILTER BY WILAYA
        if ($request->filled('wilaya')) {
            $query->whereHas('order', function ($query) {
                $query->where('wilaya', request('wilaya'));
            });
        }

        // FILTERING BY DATE
        if ($request->has('date')) {
            $date = $request->input('date');
            if ($date == 'nouveau') {
                $query->orderBy('created_at', 'desc');
            } elseif ($date == 'ancien') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $deliveries = $query->paginate(10);
        // GETTING ALL WILAYAS
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('deliveryMan.deliveries', [
            'deliveries' => $deliveries,
            'wilayas' => $wilayas,
        ]);
    }

    public function pendingDeliveries(Request $request)
    {
        $query = Delivery::select(
            'id',
            'status',
            'created_at',
            'updated_at',
            'order_id',
            'deliveryMan_id'
        )
            ->where('status', 'delivering')
            ->where('deliveryMan_id', auth()->user()->id);

        // FILTERING BY ARTISAN NAME

        if ($request->has('search')) {
            $query->whereHas('order.artisan', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%')
                    ->orWhere(
                        'num_telephone',
                        'like',
                        '%'.request('search').'%'
                    )
                    ->orWhere('email', 'like', '%'.request('search').'%')
                    ->orWhereRaw(
                        "CONCAT(nom, ' ', prenom) LIKE ?",
                        '%'.request('search').'%'
                    );
            });
        }

        // FILTER BY WILAYA

        if ($request->filled('wilaya')) {
            $query->whereHas('order', function ($query) {
                $query->where('wilaya', request('wilaya'));
            });
        }

        // FILTERING BY DATE

        if ($request->has('date')) {
            $date = $request->input('date');
            if ($date == 'desc') {
                $query->orderBy('created_at', 'desc');
            } elseif ($date == 'asc') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $deliveries = $query->paginate(10);
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('deliveryMan.pending-deliveries', [
            'deliveries' => $deliveries,
            'wilayas' => $wilayas,
        ]);
    }

    public function finishedDeliveries(Request $request)
    {
        $query = Delivery::select(
            'id',
            'status',
            'created_at',
            'updated_at',
            'order_id',
            'deliveryMan_id'
        )
            ->where('status', 'delivered')
            ->where('deliveryMan_id', auth()->user()->id);

        // FILTERING BY ARTISAN NAME

        if ($request->has('search')) {
            $query->whereHas('order.artisan', function ($query) {
                $query
                    ->where('nom', 'like', '%'.request('search').'%')
                    ->orWhere('prenom', 'like', '%'.request('search').'%')
                    ->orWhere(
                        'num_telephone',
                        'like',
                        '%'.request('search').'%'
                    )
                    ->orWhere('email', 'like', '%'.request('search').'%')
                    ->orWhereRaw(
                        "CONCAT(nom, ' ', prenom) LIKE ?",
                        '%'.request('search').'%'
                    );
            });
        }

        // FILTER BY WILAYA

        if ($request->filled('wilaya')) {
            $query->whereHas('order', function ($query) {
                $query->where('wilaya', request('wilaya'));
            });
        }

        // FILTERING BY DATE

        if ($request->has('date')) {
            $date = $request->input('date');
            if ($date == 'desc') {
                $query->orderBy('created_at', 'desc');
            } elseif ($date == 'asc') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $latestDeliveries = $query->paginate(10);
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('deliveryMan.finished-deliveries', [
            'deliveries' => $latestDeliveries,
            'wilayas' => $wilayas,
        ]);
    }

    public function showDelivery(Delivery $delivery)
    {
        return view('deliveryMan.show', ['delivery' => $delivery]);
    }

    public function updateDelivery(Request $request, Delivery $delivery)
    {
        $data = $request->validate([
            'status' => 'required|in:delivering,delivered',
        ]);

        if ($data['status'] == 'delivered') {
            Mail::to($delivery->order->artisan->email)->send(new DeliveredPackage($delivery));
        }

        $delivery->update([
            'status' => $data['status'],
        ]);

        Alert::success('Succès', 'Livraison modifié !');

        return redirect()->route(
            'deliveryMan.deliveries.showFinishedDeliveries'
        );
    }

    public function accept(Delivery $delivery)
    {
        AcceptedDeliveryJob::dispatch($delivery);
        $delivery->update([
            'status' => 'delivering',
            'deliveryMan_id' => auth()->user()->id,
        ]);

        Alert::success('Succès', 'Livraison accepté !');

        return redirect()->route('deliveryMan.index');
    }
}
