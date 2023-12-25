@component('mail::message')
    # Commande livée avec succès!

    Votre commande a été livrée avec succès.

@component('mail::button', ['url' => $url])
    Voir la commande
@endcomponent

    Merci,

    {{ config('app.name') }}

@endcomponent
