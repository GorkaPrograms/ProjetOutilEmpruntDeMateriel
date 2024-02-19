<x-admin-layout title="Dashboard - Utilisateurs" name="Dashboard | Gestion des utilisateurs">
<div x-data="{deleting : false}" class="mt-12">
    <table>
        <thead>
            <tr>
                <td> Nom </td>
                <td> Prénom </td>
                <td> Code d'employé </td>
                <td> Rôle </td>
                <td> Gérer </td>
                <td> Supprimer </td>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td> {{ $user->last_name }} </td>
                <td> {{ $user->first_name }} </td>
                <td> {{ $user->employee_code }} </td>
                @if( $user->is_admin == 1)
                    <td> Administrateur </td>
                @else
                    <td> Utilisateur </td>
                @endif
                <td>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </td>
                <td>
                    <button type="button" x-on:click="deleting = !deleting">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </td>
            </tr>
        @empty
            <p> Aucun utilisateur trouvé </p>
        @endforelse
        </tbody>
    </table>

    <x-modal-delete-form action="#" name="l'utilisateur"></x-modal-delete-form>


</div>
</x-admin-layout>
