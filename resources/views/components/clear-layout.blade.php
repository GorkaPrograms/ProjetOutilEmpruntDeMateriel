<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="icon" type="image/x-icon" href="{{ URL('images/website_logo/GearToGoFiveIcon.png') }}" sizes="32x32">
    <link rel="icon" type="image/x-icon" href="{{ URL('images/website_logo/GearToGoFiveIcon.png') }}" sizes="192x192">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased pt-5 pb-16 md:pb-32 bg-neutral-50">
{{-- Conteneur global --}}
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <header class="flex justify-between items-center space-x-5 text-slate-900">
        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <img src="{{ URL('images/website_logo/GearToGo.png') }}" alt="" class="h-12 w-auto">
        </a>
        <div class="flex flex-row items-center gap-4">
            {{--Panier--}}
            <a href="{{route('order.cart')}}" class="relative justify-center p-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <p class="absolute top-0 right-0 ">
                    @if(\Illuminate\Support\Facades\Session::has('rentables') && count(\Illuminate\Support\Facades\Session::get('rentables')) > 0)
                        {{ count(\Illuminate\Support\Facades\Session::get('rentables')) }}
                    @endif
                </p>
            </a>
            {{-- Navigation --}}
            <nav x-data="{ open: false }" class="relative">
                <button
                    @click="open = !open"
                    @click.outside="if (open) open = false"
                    class="w-8 h-8 flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                <ul
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    tabindex="-1"
                >
                    <li><a href="{{route('my.orders')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mes locations</a></li>
                    @if (Auth::user()->is_admin)
                        <li><a href="{{ route('admin.check.password') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a></li>
                    @endif
                    <li>
                        <form action="{{route('Login.logout')}}" class="flex items-center px-4 py-2 font-semibold text-sm text-logo-green hover:bg-gray-100" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center">Déconnexion
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 ml-1">
                                    <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="mt-10 md:mt-12 lg:mt-16">
        {{ $slot }}
    </main>
</div>
</body>
</html>
