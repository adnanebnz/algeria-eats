<x-dashboard-layout :isArtisan=true>
    <div class="bg-white mt-8 md:px-5 rounded-md w-full">
        <section class="antialiased font-sans">
            <div class="py-8">
                <h2 class="text-2xl font-semibold leading-tight">Commandes</h2>
                <div class="my-2 flex sm:flex-row flex-col">
                    <div class="flex flex-row mb-1 sm:mb-0">
                        <form action="{{ route('artisan.orders') }}" method="GET">
                            <div class="relative">
                                <select name="date"
                                    class="h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-l border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option value="nouveau" @selected(request()->query('date') == 'nouveau')>Nouvelles Commandes</option>
                                    <option value="ancien" @selected(request()->query('date') == 'ancien')>Anciennes Commandes</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                    </div>
                    <div class="block relative">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <div class="flex flex-row items-center gap-3">
                            <input placeholder="Rechercher"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                                name="search" value="{{ request()->query('search') }}" />
                            <button type="submit"
                                class="
                                    rounded-sm border border-gray-400 px-4 py-2 w-full bg-white hover:bg-gray-300 text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
                                Rechercher
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Produits
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date de création
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-5 py-5  border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full border"
                                                        src="{{ $order->buyer->image ? (str_starts_with($order->buyer->image, 'http') ? $order->buyer->image : asset('storage/' . $order->buyer->image)) : asset('assets/user.png') }}" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $order->buyer->getFullName() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-gray-200 bg-white text-sm">
                                            @foreach ($order->orderItems as $item)
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $item->product->nom }} (x{{ $item->quantity }})
                                                </p>
                                                @if ($order->orderItems->count() > 1 && !$loop->last)
                                                    <hr class="my-2">
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-5 py-5 border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $order->getTotalPrice() }} DA
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-gray-200 bg-white text-sm">
                                            {{ $order->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-5 py-5 border-gray-200 bg-white text-sm">
                                            @if ($order->status == 'pending')
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                            @endif
                                            @if ($order->status == 'processing')
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                    En cours
                                                </span>
                                            @endif

                                            @if ($order->status == 'cancelled')
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Annulée
                                                </span>
                                            @endif
                                            @if ($order->status == 'completed')
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Terminée
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center justify-center gap-3">
                                                <a data-tooltip-target="tooltip-see"
                                                    href="{{ route('artisan.orders.show', ['order' => $order]) }}"
                                                    class="border border-solid border-gray-400  p-1 rounded-md hover:bg-blue-500 hover:text-white hover:border-transparent">
                                                    <div id="tooltip-see" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                        Voir la commande
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </a>
                                                <form
                                                    action="{{ route('artisan.orders.invoice', ['order' => $order]) }}"
                                                    method="POST" target="_blank">
                                                    @csrf
                                                    <button data-tooltip-target="tooltip-generate" type="submit"
                                                        class="border border-solid border-gray-400 p-1 rounded-md hover:bg-indigo-500 hover:text-white hover:border-transparent">
                                                        <div id="tooltip-generate" role="tooltip"
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                            Générer la facture
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                    action="{{ route('artisan.orders.destroy', ['order' => $order]) }}"
                                                    x-data="{ showModal: false }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Modal toggle -->
                                                    <button data-tooltip-target="tooltip-delete" type="button"
                                                        class="border border-solid border-gray-400 p-1 rounded-md hover:bg-red-500 hover:text-white hover:border-transparent"
                                                        @click="showModal = true">
                                                        <div id="tooltip-delete" role="tooltip"
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                            Supprimer la commande
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <div x-show="showModal" x-cloak
                                                        class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center">
                                                        <!-- Black background overlay -->
                                                        <div class="absolute inset-0 bg-black opacity-50">
                                                        </div>
                                                        <!-- Modal container -->
                                                        <div x-show="showModal" x-cloak
                                                            x-transition:enter="transition ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 transform translate-y-4"
                                                            x-transition:enter-end="opacity-100 transform translate-y-0"
                                                            class="relative p-8 bg-white mx-auto max-w-lg">
                                                            <!-- Modal content -->
                                                            <div @click.away="showModal = false">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between">
                                                                    <div></div>
                                                                    <button type="button" @click="showModal = false"
                                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm">
                                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="space-y-4">
                                                                    <svg class="mx-auto mb-4 text-gray-400 w-14 h-14"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                    </svg>
                                                                    <p class="text-base leading-relaxed text-gray-700">
                                                                        Vous voulez vraiment supprimer cette commande ?
                                                                    </p>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-center mt-6">
                                                                    <button type="submit"
                                                                        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                                        @click="showModal = false">Confirmer</button>
                                                                    <button type="button"
                                                                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                                        @click="showModal = false">Annuler</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-5 py-5 border-gray-200 bg-white text-sm text-center">
                                            Auccune Commande trouvée
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mx-5 my-5">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-dashboard-layout>
