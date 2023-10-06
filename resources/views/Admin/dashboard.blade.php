<!doctype html>
<html class="h-full" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Dashboard</title>
</head>
<body class="h-full">
    <div class="h-full w-[180px] bg-blue-400 flex items-center flex-col">
        <button id="manageUsersButton" class="w-full h-[50px] hover:bg-violet-600 hover:text-white hover:duration-300">Gérer les utilisateurs</button>
        <button id="manageRentablesButton" class="w-full h-[50px] hover:bg-violet-600 hover:text-white hover:duration-300">Gérer le matériel</button>
    </div>
</body>
</html>
