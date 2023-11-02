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
<div class="w-full h-20 flex justify-between align-center">
    <div></div>
    <div>
        <form action="{{ route('Login.logout') }}" method="post">
            @csrf
            <button type="submit">Deconnexion</button>
        </form>
    </div>
</div>
</body>
</html>
