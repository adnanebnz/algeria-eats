<div>
    <main>
        <div class="h-screen mb-10">
            <h1 class="mb-10 text-center text-2xl font-bold">Panier</h1>
            <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="rounded-lg md:w-2/3">
                    @foreach ($cartItems as $cartItem)
                        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start"
                            wire:key='{{ $cartItem->id }}'>
                            <img src="{{ str_starts_with($cartItem->product->images[0], 'http') ? $cartItem->product->images[0] : asset('storage/' . $cartItem->product->images[0]) }}"
                                class="w-20 rounded-lg" />
                            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                <div class="mt-5 sm:mt-0">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $cartItem->product->nom }}</h2>
                                    <p class="mt-1 text-xs text-gray-700">
                                        Catégorie :
                                        {{ $cartItem->product->categorie === 'sucree' ? 'Sucrée' : 'Salée' }}
                                    </p>
                                </div>
                                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                    <div class="flex items-center border-gray-100">
                                        <button wire:click='decreaseQuantity({{ $cartItem->product->id }})'
                                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-orange-500 hover:text-orange-50">
                                            - </button>
                                        <input class="h-8 w-8 border bg-white text-center text-xs outline-none" disabled
                                            type="number" value="{{ $cartItem->quantity }}" min="1" />
                                        <button wire:click='increaseQuantity({{ $cartItem->product->id }})'
                                            class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-orange-500 hover:text-orange-50">
                                            + </button>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <p class="text-sm">{{ $cartItem->product->prix }} DA </p>
                                        <button wire:click='remove({{ $cartItem->product->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($cartItems->count() == 0)
                        <!-- Empty cart -->
                        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0">
                            <div class="flex justify-center">
                                <img src="{{ asset('assets/cart.png') }}" alt="empty-cart" class="w-24" />
                            </div>
                            <div class="flex items-center justify-center">
                                <p class="text-lg font-bold">Votre panier est vide!</p>
                            </div>
                            <div class="flex justify-center">
                                <p class="text-sm text-gray-500">Lil semble que vous n'ayez ajouté aucun article à votre
                                    panier
                                    encore.
                                </p>
                            </div>
                            <div class="flex justify-center">
                                <a href="{{ route('product.index') }}"
                                    class="mt-6 text-center w-56 rounded-md bg-orange-500 py-1.5 font-medium text-orange-50 hover:bg-orange-600">Poursuivre
                                    vos achats</a>
                            </div>
                        </div>
                    @endif
                </div>
                @if ($cartItems->count() > 0)
                    <!-- Sub total -->
                    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        @foreach ($cartItems as $cartItem)
                            <div class="mb-2 flex justify-between">
                                <p class="text-gray-700">{{ $cartItem->product->nom }} &times;
                                    {{ $cartItem->quantity }}</p>
                                <p class="text-gray-700">{{ $cartItem->product->prix * $cartItem->quantity }} DA</p>
                            </div>
                        @endforeach

                        <hr class="my-4" />
                        <div class="flex justify-between mb-6">
                            <p class="text-lg font-bold">Total</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold">{{ $totalPrice }} DA</p>
                            </div>
                        </div>
                        <div class="flex items-center justif-center w-full">
                            <a class="text-center w-full rounded-md bg-orange-500 py-1.5 px-4 font-medium text-orange-50
                            hover:bg-orange-600"
                                href="{{ route('checkout.index') }}">Confirmer</a>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </main>
</div>
