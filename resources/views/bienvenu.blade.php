<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Epo restaurant</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="fixed top-0 left-0 z-0">
            <img class="object-cover w-screen h-screen" src="{{asset('assets/image/client.jpg')}}" alt="">
        </div>
        @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        <div class="relative flex justify-center gap-4 p-4 bg-slate-200 text-lg">
            <a href="/" class="transition ease-in-out px-2 py-1 hover:underline hover:-translate-y-1 hover:scale-110 duration-300" >Acceuil</a>
             <a href="{{route('repas.index')}}" class="transition ease-in-out px-2 py-1 hover:underline hover:-translate-y-1 hover:scale-110 duration-300">Nos repas</a>
            <a href="/" class="transition ease-in-out px-2 py-1 hover:underline hover:-translate-y-1 hover:scale-110 duration-300">Nous contacter</a>
        </div>
        <div class="relative flex justify-center p-4 bg-orange-300 text-lg">
            <div class="text-2xl font-bold italic font-serif">Epo restaurant</div>
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <a href="{{route('commande.create')}}" class="animate-bounce bg-orange-300 font-bold border-2 border-orange-700 rounded px-2 py-1">
                Commander
            </a>
        </div>
        @livewireScripts
    </body>
</html>
