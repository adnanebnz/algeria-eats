<x-dashboard-layout :isArtisan=true>
    <div class="py-4 px-4 mt-8 bg-white rounded-md shadow-md">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Commande
                #{{ $order->id }}</h1>
            <p class="text-base font-medium leading-6 text-gray-600">
                {{ \Carbon\Carbon::parse($order->created_at)->locale('fr_FR')->isoFormat('Do MMMM YYYY \à H:mm') }}</p>
        </div>
        <div
            class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex md:flex-row flex-col md:gap-5 gap-2 w-full">
                    <div
                        class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                        <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">
                            Panier du client</p>
                        @foreach ($order->orderItems as $item)
                            <div
                                class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                <div class="pb-4 md:pb-8 w-full md:w-32">
                                    <img class="w-full hidden md:block rounded-sm"
                                        src="{{ str_starts_with($item->product->images[0], 'http') ? $item->product->images[0] : asset('storage/' . $item->product->images[0]) }}" />
                                </div>
                                <div
                                    class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                    <div class="w-full flex flex-col justify-start items-start space-y-8">
                                        <h3 class="text-md font-semibold leading-4 text-gray-800">
                                            {{ $item->product->nom }}</h3>
                                        <div class="flex justify-start items-start flex-col space-y-2">
                                            <p class="text-sm leading-none text-gray-800"><span
                                                    class="text-gray-300">Type:
                                                </span>
                                                {{ $item->product->categorie === 'sucree' ? 'Sucrée' : 'Salée' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between space-x-8 items-start w-full">
                                        <p class="text-sm xl:text-md leading-6">{{ $item->product->prix }} DA</p>
                                        <p class="text-sm xl:text-lg leading-6 text-gray-800">{{ $item->quantity }}
                                        </p>
                                        <p class="text-base xl:text-lg font-semibold leading-6 text-gray-800">
                                            {{ $item->quantity * $item->product->prix }} DA</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="bg-gray-50 w-full xl:w-7/12 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Client</h3>
                        <div
                            class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                            <div class="flex flex-col justify-start items-start flex-shrink-0">
                                <div
                                    class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                    <img src="{{ $order->buyer->image ? (str_starts_with($order->buyer->image, 'http') ? $order->buyer->image : asset('storage/' . $order->buyer->image)) : asset('assets/user.png') }}"
                                        class="h-10 w-10 rounded-full border" />
                                    <p class="text-base font-semibold leading-4 text-left text-gray-800">
                                        {{ $order->buyer->getFullName() }}</p>
                                </div>

                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 7L12 13L21 7" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <p class="cursor-pointer text-sm leading-5 ">{{ $order->buyer->email }}</p>
                                </div>
                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="24" height="24"
                                        class="text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                    <p class="cursor-pointer text-sm leading-5 ">{{ $order->buyer->num_telephone }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                                <div
                                    class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                                    <div
                                        class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                                        <p
                                            class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">
                                            Adresse de Livraison</p>
                                        <p
                                            class="w-48 lg:w-full text-center md:text-left text-sm leading-5 text-gray-600">
                                            {{ $order->adresse }}</p>
                                    </div>
                                    <div
                                        class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-2">
                                        <p
                                            class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">
                                            Wilaya de Livraision</p>
                                        <p
                                            class="w-48 lg:w-full xl:w-48 text-center md:text-left text-lg leading-5 text-gray-600">
                                            {{ $order->wilaya }}</p>
                                    </div>
                                    <div
                                        class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-2">
                                        <p
                                            class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">
                                            Daira de Livraision</p>
                                        <p
                                            class="w-48 lg:w-full xl:w-48 text-center md:text-left text-lg leading-5 text-gray-600">
                                            {{ $order->daira }}</p>
                                    </div>
                                    <div
                                        class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-2">
                                        <p
                                            class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">
                                            Commune de Livraision</p>
                                        <p
                                            class="w-48 lg:w-full xl:w-48 text-center md:text-left text-lg leading-5 text-gray-600">
                                            {{ $order->commune }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex justify-center md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Résumé</h3>
                        <div
                            class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            @foreach ($order->orderItems as $item)
                                <div class="flex justify-between w-full">
                                    <p class="text-sm  text-gray-800">{{ $item->product->nom }}
                                        x{{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $item->product->prix * $item->quantity }} DA</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base font-semibold leading-4 text-gray-800">Total</p>
                            <p class="text-base font-semibold leading-4 text-gray-600">
                                {{ $order->getTotalPrice() }} DA
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Livraison</h3>
                        <p class="text-sm text-gray-800">
                            En attribuant une commande à un livreur, elle devient visible pour tous les livreurs. Ils
                            peuvent accepter ou refuser en temps réel.
                        </p>
                        @if ($order->status == 'completed' && $delivery === null)
                            <p class="text-base font-semibold leading-4 text-gray-800">Status : <span
                                    class="mt-2 px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En
                                    attente d'affectation</span></p>
                            <form action="{{ route('artisan.deliveries.affect', $order) }}", method="POST">
                                @csrf
                                <button type="submit"
                                    class="hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 py-5 w-96 md:w-full bg-gray-800 text-base font-medium leading-4 text-white">Affecter
                                    à un livreur</button>
                            </form>
                        @endif
                        @if ($delivery && $delivery?->status == 'not_started')
                            <p class="text-base font-semibold leading-4 text-gray-800">Status : <span
                                    class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">En
                                    attente d'un livreur</span></p>
                        @elseif ($delivery?->deliveryMan_id !== null)
                            <p class="text-base font-semibold leading-4 text-gray-800">Status : <span
                                    class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">Affecté</span>
                            </p>
                            @if ($delivery)
                                <a href="{{ route('artisan.deliveries.show', $delivery) }}"
                                    class="text-center hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 py-5 w-96 md:w-full bg-gray-800 text-base font-medium leading-4 text-white">Voir
                                    les details</a>
                            @endif
                        @endif
                    </div>
                    <div class="flex flex-col justify-between px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Status de la commande</h3>
                        <p class="text-sm<">
                            Vous pouvez changer le status de la commande ici.
                        </p>
                        <form action="{{ route('artisan.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select rounded-md w-full">
                                <option value="not_started" {{ $order->status == 'not_started' ? 'selected' : '' }}>En
                                    attente
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En
                                    cours
                                </option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                    Terminée
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                    Annulée
                                </option>
                            </select>

                            <div class="my-4">
                                <p>Status actuel: @if ($order->status == 'not_started')
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @endif
                                    @if ($order->status == 'processing')
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            En cours
                                        </span>
                                    @endif

                                    @if ($order->status == 'cancelled')
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Annulée
                                        </span>
                                    @endif
                                    @if ($order->status == 'completed')
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Terminée
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <button type="submit"
                                class="hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 py-5 w-96 md:w-full bg-gray-800 text-base font-medium leading-4 text-white mt-1">Changer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
