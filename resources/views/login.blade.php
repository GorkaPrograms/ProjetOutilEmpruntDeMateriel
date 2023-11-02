<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
    <div class="w-full h-[100px] bg-blue-400 flex justify-center items-center">
        <h1 class="text-3xl">Computer Materiel Lending</h1>
    </div>
    <div class="w-full h-screen bg-gray-300 flex items-center justify-center">
        @if (session('nomatch'))
            <div class="w-full bg-yellow-400 alert alert-success flex justify-center items-center">
                {{ session('nomatch') }}
            </div>
        @endif
        <form action="{{ route('Login.Login') }}" method="POST" class="flex flex-col">
            @csrf
            <input type="number" name="employee_code" placeholder="Code employer">
            <button type="submit">S'authentifier</button>
        </form>
    </div>
    </body>
</html>