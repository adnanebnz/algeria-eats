<x-user-view>
    <div class="py-4 px-4 mt-8 bg-white rounded-md shadow-md">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Livraison
                #{{ $delivery->id }} </h1>
            <p class="hover:underline text-gray-800">
                Commande #{{ $delivery->order_id }}
            </p>
            <p class="text-base font-medium leading-6 text-gray-600">
                {{ \Carbon\Carbon::parse($delivery->updated_at)->locale('fr_FR')->isoFormat('Do MMMM YYYY \à H:mm') }}
            </p>
        </div>
        <div
            class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex md:flex-row flex-col md:gap-5 gap-2 w-full">
                    <div
                        class="bg-gray-50 w-full flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Livreur</h3>
                        <div
                            class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                            <div class="flex flex-col justify-start items-start flex-shrink-0">
                                <div
                                    class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                    <img src="{{ $delivery->deliveryMan->user->image ? (str_starts_with($delivery->deliveryMan->user->image, 'http') ? $delivery->deliveryMan->user->image : asset('storage/' . $delivery->deliveryMan->user->image)) : asset('assets/user.png') }}"
                                        class="h-10 w-10 object-cover rounded-full border" />
                                    <p class="text-base font-semibold leading-4 text-left text-gray-800">
                                        {{ $delivery->deliveryMan->user->getFullName() }}</p>
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
                                        {{ $delivery->deliveryMan->user->email }}</p>
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
                                        {{ $delivery->deliveryMan->user->num_telephone }}
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
                                        {{ $delivery->deliveryMan->user->adresse }} -
                                        {{ $delivery->deliveryMan->user->wilaya }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                    <h3 class="text-xl font-semibold leading-5 text-gray-800">Status de la livraison</h3>
                    <p class="text-sm">
                        Voir le status de la livraison
                    </p>
                    <div class="flex items-center justify-center">
                        @if ($delivery->status == 'pending')
                            <div class="flex justify-center items-center space-x-4">
                                <span class="font-semibold leading-5 text-gray-800">En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-6 h-6 text-gray-800">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6m16-6a9.003 9.003 0 00-9-9v0a9.003 9.003 0 00-9 9v0a9.003 9.003 0 009 9v0a9.003 9.003 0 009-9z">
                                    </path>
                                </svg>
                        @endif
                        @if ($delivery->status == 'delivering')
                            <span
                                class="p-2 inline-flex leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                En cours de livraison
                            </span>
                        @endif
                        @if ($delivery->status == 'delivered')
                            <span
                                class="p-2 inline-flex leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                Livrée
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-user-view>
