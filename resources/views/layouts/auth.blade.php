<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

<body class="antialiased h-full">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <a href="{{ route('index') }}">
                <img src="{{ asset('assets/LOGO.png') }}" alt="Logo" class="h-16 object-fill">
            </a>
        </div>
        @if ($page === 'login')
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
                <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                    <form action="{{ $action }}" method="POST" novalidate>
                        @csrf
                        <div class="space-y-6">
                            {{ $slot }}

                            <div>
                                <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500">{{ $submitMessage }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @elseif($page === 'register')
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[800px] w-full">
                <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                    {{ $slot }}
                </div>
            </div>
        @endif
    </div>
    @livewireScripts
    @include('sweetalert::alert')
</body>

</html>
