<div>
    <table class="min-w-full leading-normal mt-5">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Id
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Nom du client
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Email
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Numéro de téléphone
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Quantité
                </th>
                @if (auth()->user()->artisan)
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Actions
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="px-5 py-5  bg-white text-sm">
                        {{ $order->id }}
                    </td>

                    <td class="px-5 py-5  bg-white text-sm">
                        {{ $order->buyer->getFullName() }}
                    </td>
                    <td class="px-5 py-5  bg-white text-sm">
                        {{ $order->buyer->email }}
                    <td class="px-5 py-5  bg-white text-sm">
                        {{ $order->buyer->num_telephone }}
                    </td>
                    <td class="px-5 py-5  bg-white text-sm">
                        {{ $order->orderItems->where('product_id', $product->id)->first()->quantity }}
                    </td>
                    <td class="px-5 py-5 bg-white text-sm flex items-center justify-center gap-3 mt-1">
                        @if (auth()->user()->artisan)
                            <a href="{{ route('artisan.orders.show', ['order' => $order]) }}"
                                class="bg-orange-700 text-white px-4 py-2 rounded-md hover:bg-orange-500">Voir</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-slate-400 text-center p-4" colspan="7">Aucun résultat.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{ $orders->links(data: ['scrollTo' => '#products']) }}
    </div>
</div>
