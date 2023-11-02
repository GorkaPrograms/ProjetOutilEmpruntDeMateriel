<!DOCTYPE html>
<html class="w-full h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--Polices--}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <title>CML | Computer Material Lending</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased w-full h-full">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <h1 class="text-8xl underline underline-offset-8 mb-16">Computer Material Lending</h1>
        @if (session('nomatch'))
            <div class="w-full bg-yellow-400 alert alert-success flex justify-center items-center">
                {{ session('nomatch') }}
            </div>
        @endif
        <form action="{{ route('Login.Login') }}" method="POST" class="flex flex-col">
            @csrf
            <input type="text" name="employee_code" placeholder="Code employé" class="text-2xl rounded-md mb-5 bg-stone-100 py-2 px-4 border-2 border-stone-400">
            <button type="submit" class="text-2xl flex flex-row justify-center shadow-inner bg-stone-200 p-1 rounded-md hover:bg-[#494958] hover:scale-110 hover:cursor-pointer hover:text-white ease-in-out duration-200">S'authentifier</button>
        </form>
    </div>
    </body>
</html>
