@component('mail::message')
    # Vous avez une nouvelle commande

    Bonjour {{ $order->artisan->getFullName() }},

    Vous avez une nouvelle commande:

@component('mail::table')
    | Produit         | Quantité       |
    |:---------------:|:--------------:|
    @foreach ($order->orderItems as $item)
    | {{ $item->product->nom }} | {{ $item->quantity }} |
    @endforeach
@endcomponent

    Montant total: {{ $order->getTotalPrice() }} DA

    Cordialement,

    Algeria Eats

@endcomponent
