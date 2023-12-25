<x-dashboard-layout :isAdmin=true>
    <div class="mt-5">
        <div class="md:mb-7 mb-3 flex justify-end">
            <form action="{{ route('admin.index') }}" method="GET">
                <label for="period" class="text-sm text-gray-800">Sélectionnez la période :</label>
                <select id="period" name="period"
                    class="form-select rounded-md py-1 text-sm text-gray-800 focus:ring-orange-500 focus:border-orange-500">
                    <option value="7" @selected(request()->query('period') == '7')>Les 7 derniers jours</option>
                    <option value="30" @selected(request()->query('period') == '30')>Les 30 derniers jours</option>
                    <option value="90" @selected(request()->query('period') == '90')>90 derniers jours</option>
                    <option value="365" @selected(request()->query('period') == '365')>365 derniers jours</option>
                </select>
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition-all text-white font-medium text-sm py-1 px-4 rounded ml-3">Soumettre</button>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:mb-10 mb-5">
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Nombre de visiteurs et de pages vues</h3>
                <div>
                    <canvas id="visitorsPageViewsChart" class="h-60"></canvas>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Type d'utilisateurs</h3>
                <div>
                    <canvas id="userTypesChart" class="h-60"></canvas>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
                <h3 class="font-bold text-gray-800 mb-4">Top Navigateurs</h3>
                <div>
                    <canvas id="browserChart" class="h-60"></canvas>
                </div>
            </div>


            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Meilleurs systèmes d'exploitation</h3>
                <div>
                    <canvas id="operatingSystemChart" class="h-60"></canvas>
                </div>
            </div>
        </div>

        <h1 class="font-bold text-lg text-gray-700 mb-2">Aperçu des statistiques</h1>
        <livewire:user-statistic />
        <livewire:product-statistic />
    </div>

    <script>
        var operatingSystems = @json($topOperatingSystems->pluck('operatingSystem'));
        var screenPageViews = @json($topOperatingSystems->pluck('screenPageViews'));

        var operatingSystemChart = new Chart(document.getElementById('operatingSystemChart'), {
            type: 'bar',
            data: {
                labels: operatingSystems,
                datasets: [{
                    label: "Vues des pages d'écran par système d'exploitation",
                    data: screenPageViews,
                    backgroundColor: ['#3b82f6', '#60a5fa'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        labels: operatingSystems,
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Vues des pages d'écran",
                        },
                    },
                },
                legend: {
                    display: false,
                },
            }
        });

        var browsers = @json($topBrowsers->pluck('browser'));
        var screenPageViewsBrowsers = @json($topBrowsers->pluck('screenPageViews'));

        var browserChart = new Chart(document.getElementById('browserChart'), {
            type: 'bar',
            data: {
                labels: browsers,
                datasets: [{
                    label: "Vues des pages d'écran par navigateur",
                    data: screenPageViewsBrowsers,
                    backgroundColor: ['#3b82f6', '#60a5fa'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        labels: browsers,
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Screen Page Views',
                        },
                    },
                },
                legend: {
                    display: false,
                },
            }
        });

        var userTypesData = @json($userTypes);

        var userTypesTranslations = {
            'new': 'nouveau',
            'returning': 'retournant',
            // Add more translations as needed
        };

        var userTypes = userTypesData.map(function(item) {
            return userTypesTranslations[item.newVsReturning] || item.newVsReturning;
        });

        var users = userTypesData.map(function(item) {
            return item.activeUsers;
        });

        var userTypesChart = new Chart(document.getElementById('userTypesChart'), {
            type: 'pie',
            data: {
                labels: userTypes,
                datasets: [{
                    data: users,
                    backgroundColor: ['#3b82f6', '#60a5fa'], // Add more colors as needed
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

        var visitorsPageViewsData = @json($mostVisitorsAndPageViews);

        var dates = @json(
            $mostVisitorsAndPageViews->pluck('date')->map(function ($date) {
                return $date->toDateString();
            }));

        var activeUsers = visitorsPageViewsData.map(function(item) {
            return item.activeUsers;
        });

        var screenPageViews = visitorsPageViewsData.map(function(item) {
            return item.screenPageViews;
        });

        var visitorsPageViewsChart = new Chart(document.getElementById('visitorsPageViewsChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Utilisateurs actifs',
                    data: activeUsers,
                    borderColor: '#3b82f6',
                    fill: false,
                }, {
                    label: "Vues des pages d'écran",
                    data: screenPageViews,
                    borderColor: '#60a5fa',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {

                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Comte',
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                },
            },
        });
    </script>
</x-dashboard-layout>
