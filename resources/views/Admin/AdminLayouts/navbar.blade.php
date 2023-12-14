<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
<section id="navbar" class="border-b border-gray-600 fixed top-0 w-full h-[60px] bg-white z-1000 overflow-x-hidden">
    <div class="w-full h-full flex justify-between items-center px-4">
        <div class="w-auto h-full flex justify-center items-center gap-4">
            <img src="{{ URL('images/logo4.png') }}" alt="" class="w-10 h-10">
            <h1 class="font-bold text-2xl">Administration</h1>
        </div>
        <div class="w-auto h-full flex justify-center items-center">
            <form action="#" method="POST">
                @csrf
                <button type="submit" class=" bg-black text-white px-2 py-1">Déconnexion</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>



