<x-default-layout>
    <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32 pb-4 md:pb-16">
        <div class="md:px-4 px-3 md:pt-8">
            <p class="text-xl font-medium">Résumé de la commande</p>
            <p class="text-gray-400">Vérifiez vos articles.</p>
            <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                @foreach ($cartItems as $cartItem)
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                            <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                                src="{{ str_starts_with($cartItem->product->images[0], 'http') ? $cartItem->product->images[0] : asset('storage/' . $cartItem->product->images[0]) }}"
                                alt="" />
                            <div class="flex w-full flex-col px-4 py-4">
                                <span class="font-semibold">{{ $cartItem->product->nom }}</span>
                                <span class="float-right text-gray-400">Catégorie :
                                    {{ $cartItem->product->categorie === 'sucree' ? 'Sucrée' : 'Salée' }}</span>
                                <p class="text-lg font-bold">{{ $cartItem->product->prix }} DA</p>
                            </div>
                        </div>
                        <p class="font-semibold text-xl mr-2.5 md:mr-0">
                            &times; {{ $cartItem->quantity }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="mt-10 bg-gray-50 px-4 py-8 lg:mt-0 rounded-md">
            <p class="text-xl font-medium">Détails du paiemet</p>
            <p class="text-gray-400">Finalisez votre commande en fournissant vos informations de paiement.</p>
            <livewire:create-order />
        </div>
    </div>

</x-default-layout>
