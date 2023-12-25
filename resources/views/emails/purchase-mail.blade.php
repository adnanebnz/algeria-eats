@component('mail::message')
     # Votre facture

     Bonjour {{ $order->buyer->getFullName() }},

     Nous vous remercions pour votre commande. Voici les détails de votre facture :

@component('mail::table')
     | Produit         | Quantité       | Prix unitaire   | Prix Total      |
     |:---------------:|:--------------:|:---------------:|:---------------:|
     @foreach ($invoice->items->all() as $item)
     | {{ $item->title }} | {{ $item->quantity }} | {{ $item->price_per_unit }} DA | {{ $item->sub_total_price }} DA |
     @endforeach
@endcomponent

     Montant total: {{ $invoice->total_amount }} DA

     Vous pouvez régler cette facture dans les 7 jours suivant la date d'émission.

     Merci encore pour votre achat.

     Cordialement,
     Algeria Eats

@endcomponent
