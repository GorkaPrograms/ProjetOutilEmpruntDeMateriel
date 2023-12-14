<!doctype html>
<html class="h-full" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - CML</title>
    <link rel="icon" type="image" href="{{ URL('images/logo4.png') }}">
    @vite('resources/css/app.css')
</head>
<body>

<div class="w-full h-full" x-data="{deleting:false}">
    <!-- navbar-->
    @include('Admin.AdminLayouts.navbar')
    <!-- sidebar-->
    @include('Admin.AdminLayouts.sidebar')

    <section id="content" class="flex flex-col z-10 ml-[280px] h-screen px-6 pb-6 pt-[82px] bg-gray-300">
        <div class="w-fit flex flex-col justify-between bg-gray-50 px-12 py-10 rounded-md shadow-md">

            <h2>Liste des utilisateurs</h2>
            <table class="text-left p-1 border-collapse shadow-md">
                <thead class="bg-gray-900 text-gray-50">
                    <tr class="rounded-t-md">
                        <th class="rounded-tl-md">Nom</th>
                        <th>Prénom</th>
                        <th>Code employé</th>
                        <th>Rôle</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody class="border-b-2 border-b-gray-950 border-opacity-20">
                    @forelse($users as $user)
                        <tr class="odd:bg-gray-200 even:bg-gray-300">
                            <td> {{ $user->first_name }} </td>
                            <td> {{ $user->last_name }} </td>
                            <td> {{ $user->employee_code }} </td>
                            @if($user->is_admin == 1)
                                <td> Administrateur </td>
                            @else
                                <td> Utilisateur </td>
                            @endif
                            <td>modifier</td>
                            <div>
                                <td><button x-on:click="deleting = !deleting" class="w-full flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                    {{--Formulaire de suppression--}}
                                    <x-modal-delete-form action="" name="l'utilisateur"></x-modal-delete-form>
                                    {{--action="{{ route('delete.user', ['user' => $user]) }}" name="l'utilisateur"--}}
                                </td>
                            </div>
                        </tr>
                    @empty
                        <p>Aucun utilisateur trouvé</p>
                    @endforelse
                </tbody>
            </table>


        </div>
    </section>
</div>


</body>
</html>
