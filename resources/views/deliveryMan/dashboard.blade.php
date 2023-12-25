<x-dashboard-layout :isDeliver=true>
    <div class="bg-gray-50">
        <div class="mt-8">
            <div class="flex flex-col md:flex-row px-4 md:px-0 gap-5 items-center justify-center">
                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Status des livraisons</h3>
                        @if ($countday == 0 && $uncompleted == 0)
                            <p class="text-base font-normal text-gray-600">Aucune livraison accepté.</p>
                        @else
                            <div>
                                <canvas id="deliveriestoday" height="400"></canvas>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Dernières Livraisons disponibles</h3>
                                <span class="text-base font-normal text-gray-500">Ceci est une liste des dernières
                                    livraisons disponibles</span>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('deliveryMan.deliveries') }}"
                                    class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">Voir
                                    tout</a>
                            </div>
                        </div>
                        <div class="flex flex-col mt-8">
                            <div class="overflow-x-auto rounded-lg">
                                <div class="align-middle inline-block min-w-full">
                                    <div class="shadow overflow-hidden sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Artisan
                                                    </th>
                                                    <th scope="col"
                                                        class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Destination
                                                    </th>
                                                    <th scope="col"
                                                        class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date de soumission
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                                @forelse ($latestNotAcceptedDeliveries as $delivery)
                                                    <tr>
                                                        <td
                                                            class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                            Commande id <span
                                                                class="font-semibold">{{ $delivery->order->artisan->getFullName() }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                            {{ $delivery->order->adresse - $delivery->order->wilaya - $delivery->order->commune }}
                                                        </td>
                                                        <td
                                                            class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                            {{ $delivery->created_at->format('d/m/Y') }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3"
                                                            class="p-4 text-center whitespace-nowrap text-sm font-normal text-gray-600">
                                                            Aucune livraison disponible.
                                                        </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <h1 class="font-bold text-lg text-gray-700 py-4">Aperçu des statistiques</h1>
                <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex flex-row space-x-4 items-center">
                            <div id="stats-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 tex-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-amber-500 text-sm font-medium uppercase leading-4">Livraisons par mois
                                </p>
                                <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                    <span>{{ $countmonth }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex flex-row space-x-4 items-center">
                            <div id="stats-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 tex-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-indigo-500 text-sm font-medium uppercase leading-4">Livraisons par
                                    semaines
                                </p>
                                <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                    <span>{{ $countweek }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex flex-row space-x-4 items-center">
                            <div id="stats-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 tex-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-teal-500 text-sm font-medium uppercase leading-4">Livraisons par jours
                                </p>
                                <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                    <span>{{ $countday }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Évoluitions des livraisons par mois</h3>
                @if ($countmonth == 0)
                    <p class="text-sm text-gray-600">Pas de données disponibles.</p>
                @else
                    <div class="h-[350px]">
                        <canvas id="deliveriesByMonthChart"></canvas>
                    </div>
                @endif
            </div>
            <h1 class="font-bold text-lg text-gray-700 py-4">Livraisons terminées</h1>
            <div class="bg-white shadow-md rounded-md">
                <div class="flex flex-col">
                    <div class="rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow sm:rounded-lg">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Artisan
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Client
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date de livraison
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($deliveries as $delivery)
                                            <tr>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img class="w-full h-full rounded-full border"
                                                                src="{{ $delivery->order->artisan->image ? (str_starts_with($delivery->order->artisan->image, 'http') ? $delivery->order->artisan->image : asset('storage/' . $delivery->order->artisan->image)) : asset('assets/user.png') }}" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                {{ $delivery->order->artisan->getFullName() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img class="w-full h-full rounded-full border"
                                                                src="{{ $delivery->order->buyer->image ? (str_starts_with($delivery->order->buyer->image, 'http') ? $delivery->order->buyer->image : asset('storage/' . $delivery->order->buyer->image)) : asset('assets/user.png') }}" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                {{ $delivery->order->buyer->getFullName() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                    {{ $delivery->updated_at->format('d/m/Y') }}
                                                </td>
                                                <td
                                                    class="flex items-center justify-center gap-3 px-5 py-5 border-b border-gray-200 mt-1.5 bg-white text-sm">
                                                    <a href="{{ route('deliveryMan.deliveries.showDelivery', ['delivery' => $delivery]) }}"
                                                        class="border border-solid border-gray-400  p-1 rounded-md hover:bg-amber-500 hover:text-white hover:border-transparent">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-6 h-6">
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
                                                <td colspan="4"
                                                    class="p-4 text-center whitespace-nowrap text-sm font-normal text-gray-600">
                                                    Aucune livraison effectuée.
                                                </td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $deliveries->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        var deliveriestoday = new Chart(document.getElementById('deliveriestoday'), {
            type: 'pie',
            data: {
                labels: ['Complété', 'Non complété'],
                datasets: [{
                    data: [{{ $countday }}, {{ $uncompleted }}],
                    backgroundColor: ['#e5e5e5', '#8B8B8D'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                }
            }
        });

        var deliveriesByMonth = new Chart(document.getElementById('deliveriesByMonthChart'), {
            type: 'line',
            data: {
                labels: @json(array_keys($deliveriesPerMonth)),
                datasets: [{
                    label: 'Livraisons par mois',
                    data: @json(array_values($deliveriesPerMonth)),
                    backgroundColor: ['#3b82f6', '#60a5fa']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    x: {
                        type: 'category',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Mois'
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nombre de livraisons'
                        },
                        stepSize: 1,
                        maxTicksLimit: 10,
                    },
                },
            }
        });
    </script>

</x-dashboard-layout>
