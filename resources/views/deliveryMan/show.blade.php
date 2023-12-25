<x-dashboard-layout :isDeliver=true>
    <div class="py-4 px-4 mt-8 bg-white rounded-md shadow-md">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Livraison
                #{{ $delivery->id }} </h1>
            <p class="text-base font-medium leading-6 text-gray-600">Mis a jour le
                {{ \Carbon\Carbon::parse($delivery->updated_at)->locale('fr_FR')->isoFormat('Do MMMM YYYY \à H:mm') }}
            </p>
        </div>
        <div class="mt-10 flex flex-col gap-8">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex md:flex-row flex-col md:gap-5 gap-2 w-full">
                    <div
                        class="bg-gray-50 w-full flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Artisan</h3>
                        <div
                            class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                            <div class="flex flex-col justify-start items-start flex-shrink-0">
                                <div
                                    class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                    <a href="{{ route('profile', ['user' => $delivery->order->artisan]) }}"
                                        class="flex items-center hover:underline">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full border"
                                                src="{{ $delivery->order->artisan->image ? (str_starts_with($delivery->order->artisan->image, 'http') ? $delivery->order->artisan->image : asset('storage/' . $delivery->order->artisan->image)) : asset('assets/user.png') }}" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                {{ $delivery->order->artisan->getFullName() }}
                                            </p>
                                        </div>
                                    </a>
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
                                    <p class="cursor-pointer text-sm leading-5">
                                        {{ $delivery->order->artisan->email }}</p>
                                </div>
                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="24" height="24"
                                        class="text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                    <p class="cursor-pointer text-sm leading-5 ">
                                        {{ $delivery->order->artisan->num_telephone }}
                                    </p>
                                </div>
                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>

                                    <p class="cursor-pointer text-sm leading-5 ">
                                        {{ $delivery->order->artisan->adresse }} -
                                        {{ $delivery->order->artisan->wilaya }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 w-full flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Client</h3>
                        <div
                            class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                            <div class="flex flex-col justify-start items-start flex-shrink-0">
                                <div
                                    class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                    <a href="{{ route('profile', ['user' => $delivery->order->buyer]) }}"
                                        class="flex items-center hover:underline">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full border"
                                                src="{{ $delivery->order->buyer->image ? (str_starts_with($delivery->order->buyer->image, 'http') ? $delivery->order->buyer->image : asset('storage/' . $delivery->order->buyer->image)) : asset('assets/user.png') }}" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">
                                                {{ $delivery->order->buyer->getFullName() }}
                                            </p>
                                        </div>
                                    </a>
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
                                    <p class="cursor-pointer text-sm leading-5 ">
                                        {{ $delivery->order->buyer->email }}</p>
                                </div>
                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="24" height="24"
                                        class="text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                    <p class="cursor-pointer text-sm leading-5 ">
                                        {{ $delivery->order->buyer->num_telephone }}
                                    </p>
                                </div>
                                <div
                                    class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                    <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>

                                    <p class="cursor-pointer text-sm leading-5 ">
                                        {{ $delivery->order->buyer->adresse }} -
                                        {{ $delivery->order->buyer->wilaya }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-center md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                    <h3 class="text-xl font-semibold leading-5 text-gray-800">Articles de commande</h3>
                    <div
                        class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                        @foreach ($delivery->order->orderItems as $item)
                            <div class="flex justify-between w-full">
                                <p class="text-sm  text-gray-800">{{ $item->product->nom }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    (x{{ $item->quantity }})
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <p class="text-base font-semibold leading-4 text-gray-800">Total</p>
                        <p class="text-base font-medium leading-4 text-gray-600">
                            {{ $delivery->order->orderItems->count() }} PRODUIT(S)
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-between px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                    <h3 class="text-xl font-semibold leading-5 text-gray-800">Status de la commande</h3>
                    <p class="text-sm<">
                        Vous pouvez changer le status de la commande ici.
                    </p>
                    @if ($delivery->status == 'delivered')
                        <div>
                            <span
                                class="px-3 py-2 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                La commande a été livrée
                            </span>
                        </div>
                    @else
                        <form action="{{ route('delivery.updateDelivery', $delivery) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select rounded-md w-full">
                                <option value="delivering" @selected($delivery->status == 'delivering')>En cours d'éxpedition
                                </option>
                                <option value="delivered" @selected($delivery->status == 'delivered')>Livrée
                                </option>
                            </select>

                            <div class="my-4">
                                <p>Status actuel: @if ($delivery->status == 'delivering')
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En cours d'éxpedition
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1.5 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Livrée
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <button type="submit"
                                class="hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 py-5 w-96 md:w-full bg-gray-800 text-base font-medium leading-4 text-white mt-1">Changer</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
</x-dashboard-layout>
