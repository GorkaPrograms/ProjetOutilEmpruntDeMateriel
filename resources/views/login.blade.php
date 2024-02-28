<!DOCTYPE html>
<html class="w-full h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--Polices--}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <title>Connexion - GearToGo</title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="icon" type="image/x-icon" href="{{ URL('images/website_logo/GearToGoFiveIcon.png') }}" sizes="32x32">
        <link rel="icon" type="image/x-icon" href="{{ URL('images/website_logo/GearToGoFiveIcon.png') }}" sizes="192x192">
    </head>
    <body class="antialiased pt-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <header class="flex justify-start items-center space-x-5 text-slate-900">
                {{-- Logo --}}
                <a href="{{ route('home') }}">
                    <img src="{{ URL('images/website_logo/GearToGo.png') }}" alt="" class="h-12 w-auto">

                </a>
            </header>

            <main class="-mt-[68px] flex justify-center items-center h-screen">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex justify-center items-center w-[200px] h-full">
                    <form action="{{ route('Login.Login') }}" method="POST" class="flex flex-col">
                        @csrf
                        <input type="text" name="employee_code" placeholder="Code employé" class="text-2xl rounded-md mb-5 bg-stone-100 py-2 px-4 border-2 border-stone-400">
                        <button type="submit" class="text-2xl flex flex-row justify-center shadow-inner bg-stone-200 p-1 rounded-md hover:bg-[#494958] hover:scale-110 hover:cursor-pointer hover:text-white ease-in-out duration-200">S'authentifier</button>
                    </form>
                </div>

            </main>
        </div>
    </body>
</html>
