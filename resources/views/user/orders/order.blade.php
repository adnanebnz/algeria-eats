<x-user-view>
    <div class="bg-white mt-8 md:px-5 rounded-md w-full">
        <section class="antialiased font-sans">
            <div class="py-8">
                <h2 class="text-2xl font-semibold leading-tight">Commandes</h2>
                <div class="my-2 flex sm:flex-row flex-col">
                    <div class="flex flex-row mb-1 sm:mb-0">
                        <form action="{{ route('user.orders') }}" method="GET">
                            <div class="relative">
                                <select name="date"
                                    class="h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-l border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option value="">Toutes les Livraisons</option>
                                    <option value="nouveau" @selected(request()->query('date') == 'nouveau')>Nouvelles Livraisons</option>
                                    <option value="ancien" @selected(request()->query('date') == 'ancien')>Anciennes Livraisons</option>
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
                    <div class="relative">
                        <select name="status"
                            class="h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-l border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option value="">Tous les Status</option>
                            <option value="not_started" @selected(request()->query('status') == 'not_started')>En Attente</option>
                            <option value="processing" @selected(request()->query('status') == 'processing')>En cours</option>
                            <option value="completed" @selected(request()->query('status') == 'completed')>Terminé</option>
                            <option value="cancelled" @selected(request()->query('status') == 'cancelled')>Annulé</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
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
                                        Artisan
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
                                                        src="{{ $order->artisan->image ? (str_starts_with($order->artisan->image, 'http') ? $order->artisan->image : asset('storage/' . $order->artisan->image)) : asset('assets/user.png') }}" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $order->artisan->getFullName() }}
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
                                            @if ($order->status == 'not_started')
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
                                        <td
                                            class="flex items-center justify-center gap-3 px-5 py-5 border-b border-gray-200 mt-1.5 bg-white text-sm">
                                            <a data-tooltip-target="tooltip-see"
                                                href="{{ route('user.orders.show', ['order' => $order]) }}"
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
</x-user-view>
