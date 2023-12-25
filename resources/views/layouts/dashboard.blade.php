<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgeriaEats | Tableau de bord</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6S5QH2BKMB"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-6S5QH2BKMB');
</script>

<body class="h-full overflow-x-hidden">
    <div>
        {{-- MOBILE NAV --}}
        <nav class="bg-white border-b border-gray-200 fixed w-full z-30 block md:hidden">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                        class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                        <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <a href="{{ route('index') }}" class="lg:ml-2.5">
                        <img src="{{ asset('assets/LOGO.png') }}" class="h-10" alt="Logo">
                    </a>
                </div>

            </div>
        </nav>
        {{-- MOBILE NAV END --}}

        {{-- DESKTOP NAV --}}
        <nav class="bg-white border-b border-gray-200 fixed w-full z-30 md:block hidden">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                            class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <a href="{{ route('index') }}" class="lg:ml-2.5">
                            <img src="{{ asset('assets/LOGO.png') }}" class="h-10" alt="Logo">
                        </a>
                    </div>
                    <div class="flex items-center">
                        <button id="toggleSidebarMobileSearch" type="button"
                            class="lg:hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                            <!-- Add any search button content here -->
                        </button>
                    </div>
                    {{-- USER NAV --}}
                    <div x-data="{ open: false }" x-cloak>
                        <nav :class="{ 'flex': open, 'hidden': !open }"
                            class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">


                            <div @click.away="open = false" class="relative" x-data="{ open: false }" x-cloak>
                                <button @click="open = !open"
                                    class="flex flex-row text-gray-900 bg-gray-200 items-center w-full p-4 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-orange-100 focus:bg-orange-100 focus:outline-none focus:shadow-outline">
                                    <span>{{ auth()->user()->prenom }}</span>
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                        :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                        class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 w-full md:max-w-[280px] md:w-screen mt-2 origin-top-right">
                                    <div class="px-2 pt-2 pb-4 bg-gray-50 rounded-md shadow-xl">
                                        <div class="grid grid-cols-1 gap-4">
                                            <a class="flex
                                            row items-start rounded-lg bg-transparent p-2 hover:text-black focus:text-gray-900 hover:bg-gray-200
                                            focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                                href="{{ route('user.dashobard', auth()->user()) }}">
                                                <div class="bg-orange-400 text-white rounded-lg p-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="md:h-6 md:w-6 h-4 w-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="font-semibold">Mes achats</p>
                                                    <p class="text-sm">Voir vos achats</p>
                                                </div>
                                            </a>
                                            <a class="flex row items-start rounded-lg bg-transparent p-2 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                                href="{{ route('profile', ['user' => auth()->user()]) }}">
                                                <div class="bg-orange-400 text-white rounded-lg p-3">
                                                    <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                        class="md:h-6 md:w-6 h-4 w-4">
                                                        <path
                                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="font-semibold">Profile</p>
                                                    <p class="text-sm">Voir et modifier votre profile</p>
                                                </div>
                                            </a>
                                            <a class="flex row items-start rounded-lg bg-transparent p-2 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                                href="{{ route('logout') }}">
                                                <div class="bg-orange-400 text-white rounded-lg p-3">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="md:h-6 md:w-6 h-4 w-4">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                                    </svg>

                                                </div>
                                                <div class="ml-3">
                                                    <p class="font-semibold">Déconnexion</p>
                                                    <p class="text-sm">Déconnecter vous de votre compte</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    {{-- USER NAV END --}}
                </div>
            </div>
        </nav>
        {{-- DESKTOP NAV END --}}
        <div class="flex overflow-hidden bg-white pt-16">
            <aside id="sidebar"
                class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
                aria-label="Sidebar">
                <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex-1 flex-col justify-between px-3 bg-white divide-y space-y-1">
                            <div class="flex flex-col justify-between gap-72">
                                <ul class="space-y-2 pt-5">
                                    @if ($isArtisan)
                                        <li>
                                            <a href="{{ route('artisan.index') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('artisan.index')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('artisan.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                                </svg>
                                                <span class="ml-3">Tableau de bord</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($isAdmin)
                                        <li>
                                            <a href="{{ route('admin.index') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('admin.index')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('admin.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                                </svg>
                                                <span class="ml-3">Tableau de bord</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.users.index') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('admin.users.index')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('admin.users.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ]) viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                                <span class="ml-3">Utilisateurs</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.products.index') }}"@class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('admin.products.index')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('admin.products.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ]) viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                                </svg>
                                                <span class="ml-3">Produits</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.messages.index') }}"
                                                @class([
                                                    'text-base font-normal rounded-lg flex items-center p-2 group',
                                                    request()->routeIs('admin.messages.index')
                                                        ? 'bg-orange-500 text-white'
                                                        : 'text-gray-900 hover:bg-gray-100',
                                                ])>

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('admin.messages.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                </svg>

                                                <span class="ml-3">Messages de contact</span>
                                            </a>
                                        </li>
                                    @endif
                                    {{-- ARTISAN SECTION --}}
                                    @if ($isArtisan)
                                        <li>
                                            <a href="{{ route('artisan.products') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('artisan.products')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('artisan.products')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500',
                                                    ]) viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                </svg>
                                                <span class="ml-3">Produits</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($isDeliver)
                                        <li>
                                            <a href="{{ route('deliveryMan.index') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('deliveryMan.index')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('deliveryMan.index')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                                </svg>
                                                <span class="ml-3">Tableau de bord</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('deliveryMan.deliveries') }}"
                                                @class([
                                                    'text-base font-normal rounded-lg flex items-center p-2 group',
                                                    request()->routeIs('deliveryMan.deliveries')
                                                        ? 'bg-orange-500 text-white'
                                                        : 'text-gray-900 hover:bg-gray-100',
                                                ])>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500  transition duration-75',
                                                        request()->routeIs('deliveryMan.deliveries')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                </svg>
                                                <span class="ml-3">Livraisons</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('deliveryMan.deliveries.showPendingDeliveries') }}"
                                                @class([
                                                    'text-base font-normal rounded-lg flex items-center p-2 group',
                                                    request()->routeIs('deliveryMan.deliveries.showPendingDeliveries')
                                                        ? 'bg-orange-500 text-white'
                                                        : 'text-gray-900 hover:bg-gray-100',
                                                ])>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500  transition duration-75',
                                                        request()->routeIs('deliveryMan.deliveries.showPendingDeliveries')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span class="ml-3">Livraisons en cours</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('deliveryMan.deliveries.showFinishedDeliveries') }}"
                                                @class([
                                                    'text-base font-normal rounded-lg flex items-center p-2 group',
                                                    request()->routeIs('deliveryMan.deliveries.showFinishedDeliveries')
                                                        ? 'bg-orange-500 text-white'
                                                        : 'text-gray-900 hover:bg-gray-100',
                                                ])>

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500  transition duration-75',
                                                        request()->routeIs('deliveryMan.deliveries.showFinishedDeliveries')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500 group-hover:text-gray-900',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                                </svg>
                                                <span class="ml-3">Livraisons terminés</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($isArtisan)
                                        <li>
                                            <a href="{{ route('artisan.orders') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('artisan.orders')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('artisan.orders')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                </svg>
                                                <span class="ml-3">Commandes</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('artisan.deliveries') }}" @class([
                                                'text-base font-normal rounded-lg flex items-center p-2 group',
                                                request()->routeIs('artisan.deliveries')
                                                    ? 'bg-orange-500 text-white'
                                                    : 'text-gray-900 hover:bg-gray-100',
                                            ])>

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    @class([
                                                        'w-6 h-6 text-gray-500 transition duration-75',
                                                        request()->routeIs('artisan.deliveries')
                                                            ? 'bg-orange-500 text-white'
                                                            : 'text-gray-500',
                                                    ])>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                </svg>
                                                <span class="ml-3">Livraisons</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <ul class="md:hidden block">
                                    <li>
                                        <a href="{{ route('index') }}"
                                            class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            <span class="ml-3">Acceuil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile', ['user' => auth()->user()]) }}"
                                            class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75">
                                                <path
                                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                                </path>
                                            </svg>
                                            <span class="ml-3">Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                            </svg>
                                            <span class="ml-3">Déconnexion</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
            <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64 p-4">
                @if (session('status'))
                    <div class="mt-10 rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
    <script async src="https://buttons.github.io/buttons.js"></script>
    <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
    @yield('scripts')
    @livewireScripts
    @include('sweetalert::alert')
</body>

</html>
