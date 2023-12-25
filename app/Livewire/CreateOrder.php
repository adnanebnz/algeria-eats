<?php

namespace App\Livewire;

use AnouarTouati\AlgerianCitiesLaravel\PostOffice;
use App\Jobs\GenerateInvoiceAndSendMail;
use App\Jobs\PurchaseJob;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CreateOrder extends Component
{
    public $total;

    public $adresse;

    public $cartItems;

    public $wilayas;

    public $dairas;

    public $communes;

    public $selectedWilaya = null;

    public $selectedDaira = null;

    public $selectedCommune = null;

    protected $rules = [
        'adresse' => 'required',
        'selectedWilaya' => 'required',
        'selectedDaira' => 'required',
        'selectedCommune' => 'required',
    ];

    public function mount()
    {
        $this->total = 0;
        $this->cartItems = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->cartItems as $cartItem) {
            $this->total += $cartItem->product->prix * $cartItem->quantity;
        }
        if (Cart::where('user_id', auth()->user()->id)->count() == 0) {
            Alert::error('Erreur', 'Votre panier est vide');

            return redirect()->route('index');
        }

        $this->wilayas = PostOffice::select('wilaya_code', 'wilaya_name_ascii')
            ->distinct()
            ->orderBy('wilaya_code', 'asc')
            ->get();
    }

    public function updatedSelectedWilaya($wilaya)
    {
        $this->selectedWilaya = $wilaya;
        $this->wilayas = PostOffice::select('wilaya_code', 'wilaya_name_ascii')
            ->distinct()
            ->orderBy('wilaya_code', 'asc')
            ->get();

        $this->dairas = PostOffice::select('daira_name_ascii')
            ->distinct()
            ->orderBy('daira_name_ascii', 'asc')
            ->where('wilaya_name', $wilaya)
            ->orWhere('wilaya_name_ascii', $wilaya)
            ->get();
    }

    public function updatedSelectedDaira($daira)
    {
        $this->selectedDaira = $daira;
        $this->dairas = PostOffice::select('daira_name_ascii')
            ->distinct()
            ->orderBy('daira_name_ascii', 'asc')
            ->where('wilaya_name', $this->selectedWilaya)
            ->orWhere('wilaya_name_ascii', $this->selectedWilaya)
            ->get();
        $this->wilayas = PostOffice::select('wilaya_code', 'wilaya_name_ascii')
            ->distinct()
            ->orderBy('wilaya_code', 'asc')
            ->get();

        $this->communes = PostOffice::select('commune_name_ascii')
            ->distinct()
            ->orderBy('commune_name_ascii', 'asc')
            ->where('daira_name', $daira)
            ->orWhere('daira_name_ascii', $daira)
            ->get();
    }

    public function updatedSelectedCommune($commune)
    {
        $this->selectedCommune = $commune;
        $this->communes = PostOffice::select('commune_name_ascii')
            ->distinct()
            ->orderBy('commune_name_ascii', 'asc')
            ->where('daira_name', $this->selectedDaira)
            ->orWhere('daira_name_ascii', $this->selectedDaira)
            ->get();
        $this->dairas = PostOffice::select('daira_name_ascii')
            ->distinct()
            ->orderBy('daira_name_ascii', 'asc')
            ->where('wilaya_name', $this->selectedWilaya)
            ->orWhere('wilaya_name_ascii', $this->selectedWilaya)
            ->get();
        $this->wilayas = PostOffice::select('wilaya_code', 'wilaya_name_ascii')
            ->distinct()
            ->orderBy('wilaya_code', 'asc')
            ->get();
    }

    public function store()
    {
        $data = $this->validate();
        $cartItemsByArtisan = $this->cartItems->groupBy(
            'product.artisan.user_id'
        );

        foreach ($cartItemsByArtisan as $artisanId => $cartItems) {
            // Create an order for each artisan
            $order = Order::create([
                'buyer_id' => auth()->user()->id,
                'artisan_id' => $artisanId,
                'adresse' => $data['adresse'],
                'wilaya' => $data['selectedWilaya'],
                'daira' => $data['selectedDaira'],
                'commune' => $data['selectedCommune'],
                'status' => 'not_started',
            ]);

            foreach ($cartItems as $cartItem) {
                // Create order items for each product
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'prix_total' => $cartItem->product->prix * $cartItem->quantity,
                ]);
                $cartItem->delete();
            }
            PurchaseJob::dispatch($order);
            GenerateInvoiceAndSendMail::dispatch($order);
        }

        Alert::success(
            'Succès',
            'Votre commande a été enregistrée avec succès'
        );

        return redirect()->route('index');
    }

    public function cancel()
    {
        Alert::error('Erreur', 'Votre commande a été annulée');

        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
