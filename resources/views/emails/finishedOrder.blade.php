@component('mail::message')
    # Commande traitée avec succès!

    Votre commande sera livrée dans les plus brefs délais.

@component('mail::button', ['url' => $url])
    Voir la commande
@endcomponent

    Merci,

    {{ config('app.name') }}
@endcomponent
