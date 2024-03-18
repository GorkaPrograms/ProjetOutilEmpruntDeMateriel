<x-admin-layout title="Dashboard - Emprunts" name="Dashboard | Gestion des emprunts">

    <div x-data="{details : false}" class="overflow-x-hidden mt-12 flex flex-col justify-center items-center">

        <div class="mb-12 gap-96 flex justify-between items-center">
            {{-- Formulaire de recherche --}}
            <form action="" class="w-64 pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
                <input id="search" value="{{ request()->search }}" class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher un emprunt">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>

        <table class="text-left p-1 border-collapse shadow-md w-fit">
            <thead class="text-center bg-[#494958] text-gray-50 p-1">
            <tr>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer pl-2 rounded-tl-md"> Id </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Loué à </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Status </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Loué le </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Date de retour </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer rounded-tr-md"> Détails </th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr class="odd:bg-stone-100 even:bg-stone-200">
                    <td id="id" class="py-2 pl-2"> {{ $order->id }} </td>
                    <td id="author"> {{ $order->first_name }} {{ $order->last_name }}</td>
                    <td id="status"> {{ $order->status }} </td>
                    <td id="lending_on"> Le {{ $order->created_at->format('d/m/Y') }} </td>
                    <td id="comeback_on"> Le {{ \Carbon\Carbon::parse($order->comeback_date)->format('d/m/Y') }} </td>
                    <td>
                        <div class="w-full flex justify-center">
                        <button id="detailsButton" value="{{$order->id }}" type="button" x-on:click="details = !details" class="px-5 py-0.5 flex justify-center items-center gap-2 bg-green-600 text-gray-50 rounded-full {{-- Partie hover --}} hover:bg-green-500 hover:scale-105 transition duration-200"> Voir plus
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        </div>
                    </td>
                </tr>
            @empty
                <p class="mb-4"> Aucun emprunt trouvé </p>
            @endforelse
            </tbody>
        </table>

        <div class="w-full ml-96">
            {{$orders->links()}}
        </div>

        <div x-show="details === true">
            <div class="fixed bg-gray-900 opacity-20 top-0 left-0 w-full h-full" x-on:click="details= !details"></div>

            <div class="bg-white fixed top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 min-w-[33.333333%] w-auto h-auto rounded-md">
                <button x-on:click="details = !details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fixed top-2 right-2 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div id="detailsModal">
                    <h1 class="text-xl font-bold underline underline-offset-2">Détails de l'emprunt N°<span id="lendId"></span></h1>
                    <div>
                        <p id="nameOfTheOwner"></p>
                        <p id="dateOfRentable"></p>
                        <p id="status"></p>
                        <p id="returnDate"></p>
                    </div>
                </div>
                <div class="w-full flex justify-center px-24 mb-4">
                    <button type="button" class="w-fit px-8 py-1 bg-stone-200 rounded-lg text-gray-950 font-bold {{--Partie hover--}} hover:bg-[#494958] hover:text-gray-100 transition duration-200" x-on:click="details = !details">Retour</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        const detailsButton = document.querySelectorAll('#detailsButton')
        detailsButton.forEach(function (button){
            button.addEventListener('click', function(){
                let orderRow = button.closest('tr'),
                    detailsModal = document.querySelector("#detailsModal");

                let lendId = orderRow.querySelector("#id").innerText.trim();
                let user = orderRow.querySelector("#author").innerText.trim();
                let status = orderRow.querySelector("#status").innerText.trim();
                let lendingOn = orderRow.querySelector("#lending_on").innerText.trim();


                //let name = orderRow.querySelector(".")

                detailsModal.querySelector("#nameOfTheOwner").textContent = lendId;
                detailsModal.querySelector("#dateOfRentable").textContent = user;
                detailsModal.querySelector("#status").textContent = status;
                detailsModal.querySelector("#returnDate").textContent = lendingOn;

            })
        })

    </script>

</x-admin-layout>
