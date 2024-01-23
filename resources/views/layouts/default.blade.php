<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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

<body class="antialiased pt-1">
{{-- Conteneur global --}}
<div>
    {{-- Header --}}
    <div x-data="{ open: false }" x-cloak
         class="relative flex flex-col px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8 ">
        <div class="flex flex-row items-center justify-between px-4 py-3">
            <a href="{{ route('index') }}"
               class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">
                <img src="{{ asset('assets/LOGO.png') }}" class="md:h-14 h-10" alt="logo"/>
            </a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{ 'flex': open, 'hidden': !open }"
             class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
            <a class="p-4 mt-2 text-sm font-semibold md:mt-0 md:ml-0 text-gray-900 focus:text-gray-900 hover:text-gray-500 focus:outline-none focus:shadow-outline"
               href="{{ route('contact.index') }}">Contact</a>
            <a class="p-4 mt-2 text-sm font-semibold bg-transparent md:mt-0 md:ml-0 text-gray-900 focus:text-gray-900 hover:text-gray-500 focus:outline-none focus:shadow-outline"
               href="{{ route('faq') }}">FAQ</a>
            <a class="p-4 mt-2 text-sm font-semibold bg-transparent md:mt-0 md:ml-0 text-gray-900  focus:text-gray-900 hover:text-gray-500 focus:outline-none focus:shadow-outline"
               href="{{ route('artisan.page') }}">Artisans</a>
            <a class="p-4 mt-2 text-sm font-semibold bg-transparent md:mt-0 md:ml-0 text-gray-900  focus:text-gray-900 hover:text-gray-500 focus:outline-none focus:shadow-outline"
               href="{{ route('product.index') }}">Produits</a>
            <div class="p-4 mt-2 md:p-0 text-sm font-semibold bg-transparent md:mt-0 md:ml-4 text-gray-900">
                <livewire:cart-component/>
            </div>
            @guest
                <a class="p-4 mt-2 text-sm font-semibold bg-transparent rounded-lg
                    border solid border-orange-500
                    transition-all md:mt-0 md:ml-4 text-gray-900 hover:bg-orange-500 hover:text-white focus:outline-none focus:shadow-outline"
                   href="{{ route('login') }}">Connexion</a>
                <a class="p-4 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4
                    bg-orange-500 text-white hover:bg-orange-600 focus:outline-none focus:shadow-outline
                    "
                   href="{{ route('register') }}">Créer un compte</a>
            @endguest
            @auth
                <div @click.away="open = false" class="relative z-50" x-data="{ open: false }" x-cloak>
                    <button @click="open = !open"
                            class="flex flex-row text-gray-900 bg-gray-200 items-center w-full p-4 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-orange-100 focus:bg-orange-100 focus:outline-none focus:shadow-outline">
                        <span>{{ auth()->user()->prenom }}</span>

                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
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
                                @if (auth()->user()->artisan)
                                    <a class="flex row items-start rounded-lg bg-transparent p-2  hover:text-black focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                       href="{{ route('artisan.index', ['user' => auth()->user()]) }}">
                                        <div class="bg-orange-400 text-white rounded-lg p-3">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"
                                            >
                                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold">Tableau de bord</p>
                                            <p class="text-sm">Voir et gerer vos données</p>
                                        </div>
                                    </a>
                                @endif
                                @if (auth()->user()->admin)
                                    <a class="flex row items-start rounded-lg bg-transparent p-2  hover:text-black focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                       href="{{ route('admin.index', ['user' => auth()->user()]) }}">

                                        <div class="bg-orange-400 text-white rounded-lg p-3">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"
                                            >
                                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold">Tableau de bord</p>
                                            <p class="text-sm">Voir et gerer vos données</p>
                                        </div>
                                    </a>
                                @endif
                                @if (auth()->user()->deliveryMan)
                                    <a class="flex row items-start rounded-lg bg-transparent p-2  hover:text-black focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                       href="{{ route('deliveryMan.index', ['user' => auth()->user()]) }}">
                                        <div class="bg-orange-400 text-white rounded-lg p-3">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold">Tableau de bord</p>
                                            <p class="text-sm">Voir et gerer vos données</p>
                                        </div>
                                    </a> @endif
                                {{-- LES ACHATS --}}
                                <a class="flex
        row items-start rounded-lg bg-transparent p-2 hover:text-black focus:text-gray-900 hover:bg-gray-200
        focus:bg-gray-200 focus:outline-none focus:shadow-outline"
        href="{{ route('user.dashobard', auth()->user()) }}">
    <div class="bg-orange-400 text-white rounded-lg p-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="md:h-6 md:w-6 h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
        </svg>
    </div>
    <div class="ml-3">
        <p class="font-semibold">Mes achats</p>
        <p class="text-sm">Voir vos achats</p>
    </div>
    </a>
    {{-- FIN --}}
    <a class="flex
        row items-start rounded-lg bg-transparent p-2 hover:text-black focus:text-gray-900 hover:bg-gray-200
        focus:bg-gray-200 focus:outline-none focus:shadow-outline"
        href="{{ route('profile', ['user' => auth()->user()]) }}">
        <div class="bg-orange-400 text-white rounded-lg p-3">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
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
    <a class="flex row items-start rounded-lg bg-transparent p-2  hover:text-black focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
        href="{{ route('logout') }}">
        <div class="bg-orange-400 text-white rounded-lg p-3">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="md:h-6 md:w-6 h-4 w-4">

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
@endauth
</nav>
</div>
<main class="mt-10
        md:mt-12 lg:mt-16 border-b p-4 rounded-md">
    {{ $slot }}
</main>
</div>
<footer class="pt-8 pb-6">
    <div class="container mx-auto px-4">
        <div class="flex text-left lg:text-left">
            <div class="w-full lg:w-6/12 px-4">
                <img src="{{ asset('assets/LOGO.png') }}" class="md:h-14 h-8" alt="logo" />
                <div class="mt-6 lg:mb-0 mb-6">
                </div>
            </div>
            <div class="w-full lg:w-6/12 px-4">
                <div class="flex flex-wrap items-top mb-6">
                    <div class="w-full lg:w-4/12 px-4 ml-auto">
                        <span class="block uppercase text-gray-800 text-sm font-semibold mb-2">Liens
                            Rapides</span>
                        <ul class="list-unstyled">
                            <li>
                                <a class="text-gray-800  hover:text-gray-900 font-semibold block pb-2 text-sm"
                                    href="{{ route('faq') }}">FAQ</a>
                            </li>
                            <li>
                                <a class="text-gray-800  hover:text-gray-900 font-semibold block pb-2 text-sm"
                                    href="{{ route('artisan.page') }}">Artisans</a>
                            </li>
                            <li>
                                <a class="text-gray-800  hover:text-gray-900 font-semibold block pb-2 text-sm"
                                    href="{{ route('product.index') }}">Produits</a>
                            </li>
                            <li>
                                <a class="text-gray-800  hover:text-gray-900 font-semibold block pb-2 text-sm"
                                    href="{{ route('contact.index') }}">Contactez nous</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-300">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                <div class="text-sm text-gray-600 font-semibold py-1 flex items-center gap-2 justify-center">
                    <p>
                        Copyright © <span id="get-current-year">{{ date('Y') }}
                        </span>
                    </p>
                    <p>Algeria Eats</p>
                </div>
            </div>
        </div>
    </div>
</footer>
@livewireScripts
@include('sweetalert::alert')
</body>

</html>
