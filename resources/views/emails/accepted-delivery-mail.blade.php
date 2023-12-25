@component('mail::message')
    # Acceptation de la livraison

    Bonjour {{ $delivery->order->artisan->getFullName() }},

    Votre livraison a été acceptée.

@component('mail::button', ['url' => route('artisan.deliveries.show', $delivery)])
    Voir la commande
@endcomponent

    Merci
    {{ config('app.name') }}

@endcomponent
