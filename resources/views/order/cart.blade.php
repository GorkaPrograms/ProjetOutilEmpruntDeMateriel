<x-layout>
    <p class="text-2xl underline underline-offset-4">Mes articles :</p>
    <table class="mt-8 w-full">
        <thead>
            <tr>
                <td>Matériel</td>
                <td>Quantité</td>
                <td>Supprimer</td>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$items[0]}}</td>
                    <td>{{$items[1]}}</td>
                    <td class="text-red-600 hover:cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </td>
                </tr>
          @endforeach
        </tbody>
    </table>
</x-layout>
