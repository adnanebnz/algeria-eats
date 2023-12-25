<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgeriaEats | 401</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="grid h-screen place-items-center bg-white py-24 px-6 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="font-semibold text-orange-500 text-5xl">401</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Accés non autorisé
            </h1>
            <p class="mt-6 text-base leading-7 text-gray-600">
                Désolé, vous n'avez pas l'autorization pour voir cette page
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('index') }}"
                    class="rounded-md bg-orange-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                    Retour à l'accueil
                </a>
                <a href="{{ route('contact.index') }}" class="text-sm font-semibold text-gray-900">
                    Contacter le support <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </main>
</body>

</html>
