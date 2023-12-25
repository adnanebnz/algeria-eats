<x-dashboard-layout :isArtisan=true>
    <main>
        <div class="pt-6 px-4">
            <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Types de produits</h3>
                    @if ($totalProducts == 0)
                        <p class="text-sm text-gray-600">Aucun produit n'a été ajouté</p>
                    @else
                        <div>
                            <canvas id="productChart"></canvas>
                        </div>
                    @endif
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Dernières opérations</h3>
                            <span class="text-base font-normal text-gray-500">Ceci est une liste des dernières
                                opérations</span>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('artisan.orders') }}"
                                class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">Voir tout</a>
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
                                                    Opération
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Prix Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @forelse ($latestOrders as $order)
                                                <tr>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                        Commande id <span class="font-semibold">#{{ $order->id }}
                                                        </span>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{ $order->created_at->format('d/m/Y') }}
                                                    </td>
                                                    <td
                                                        class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                        {{ $order->getTotalPrice() }} DA
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3"
                                                        class="p-4 text-center whitespace-nowrap text-sm font-normal text-gray-600">
                                                        Aucune commande n'a été passée
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
        <div class="mt-2">
            <h1 class="font-bold text-lg text-gray-700 py-4">Aperçu des statistiques</h1>
            <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 tex-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>

                        </div>
                        <div>
                            <p class="text-indigo-500 text-sm font-medium uppercase leading-4">Produits</p>
                            <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                <span>{{ $totalProducts }}</span>
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
                                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-indigo-500 text-sm font-medium uppercase leading-4">Commandes</p>
                            <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                <span>{{ $totalOrders }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>
                            <p class="text-teal-500 text-sm font-medium uppercase leading-4">Revenus</p>
                            <p class="text-gray-800 font-bold text-2xl inline-flex items-center space-x-2">
                                <span>{{ $totalIncomes }} DA</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:mt-10 mt-5">
                <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Répartition des revenus par catégorie</h3>
                    <div>
                        <canvas id="revenueBreakdownChart" height="400"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Total des ventes par mois</h3>
                    <div>
                        <canvas id="artisansChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
            <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900">Meilleurs Produits vendu</h3>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse ($topSellingProducts as $product)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-row gap-3 justify-center items-center">
                                        <img class="h-20 w-20 rounded-md"
                                            src="{{ str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0]) }}">
                                        <div class="flex flex-col">
                                            <p
                                                class="text-md font-medium
                                                text-gray-900 truncate">
                                                {{ $product->nom }}
                                            </p>
                                            <p class="text-md text-gray-500 truncate">
                                                {{ $product->categorie === 'sucree' ? 'Sucrée' : 'Salée' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-sm font-medium">Note : </p>
                                        <x-star-rating :rating="$product->rating" />
                                    </div>
                                    <div class="inline-flex items-center">
                                        <p class="text-sm font-medium">Prix :
                                            <span
                                                class="text-lg font-semibold text-gray-900">{{ $product->prix }}DA</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p class="text-sm text-gray-600">Aucun produit n'a été vendu</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        var productsByCategoryLabels = @json($customCategoryLabels);
        var productsCountByCategory = @json($productsCountByCategory);

        var productPieChart = new Chart(document.getElementById('productChart'), {
            type: 'pie',
            data: {
                labels: productsByCategoryLabels,
                datasets: [{
                    data: productsCountByCategory,
                    backgroundColor: ['#3b82f6', '#60a5fa'],
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

        var artisansChart = new Chart(document.getElementById('artisansChart'), {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Total des ventes par mois',
                    data: @json($orderCounts),
                    backgroundColor: ['#3b82f6', '#60a5fa'],
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

        var revenueBreakdownChart = new Chart(document.getElementById('revenueBreakdownChart'), {
            type: 'bar',
            data: {
                labels: @json($customLabels),
                datasets: [{
                    label: 'Revenu total par catégorie et par prix d\'une piéce',
                    data: @json($totalRevenueByCategory),
                    backgroundColor: ['#3b82f6', '#60a5fa'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        labels: @json($customLabels),
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenu total (DA)',
                        },
                    },
                },
                legend: {
                    display: false,
                },
            }
        });
    </script>

</x-dashboard-layout>
