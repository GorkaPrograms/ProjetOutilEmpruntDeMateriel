<x-clear-layout>

    <div x-data="{comeback: false}" class="overflow-x-hidden mt-12 flex flex-col justify-center items-center">

        <div class="mb-12 gap-96 flex justify-between items-center">
            {{-- Formulaire de recherche --}}
            <form action="" class="w-64 pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
                <input id="search" value="{{ request()->search }}" class="bg-neutral-50 px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher une location">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="gap-6 flex flex-col">
            @forelse($orders as $order)
                    <table class="text-left p-1 border-collapse shadow-md w-fit">
                        <thead class="text-center bg-[#494958] text-gray-50 p-1">
                        <tr>
                            <th class="w-52 text-center py-2 text-lg pr-4 pl-2 rounded-tl-md"> N° de la location : {{$order->id}} </th>
                            <th class="w-52 text-center py-2 text-lg pr-4"> Status : {{$order->status}}</th>
                            <th class="w-52 text-center py-2 text-lg pr-4"> A rendre avant le {{ \Carbon\Carbon::parse($order->comeback_date)->format('d/m/Y') }} </th>
                            <th class="w-52 text-center py-2 text-lg pr-4"> loué le {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }} </th>
                            <th class="w-52 text-center py-2 text-lg pr-4 rounded-tr-md">
                                @if ($order->status == "En location")
                                    <form action="{{ route('order.returnOrder', $order->id)}}" method="POST" class="flex justify-center items-center">
                                        @csrf
                                        @method('PUT')
                                        <button  class="bg-white rounded rounded-xl p-2 text-black">
                                            Rendre le(s) produit(s)
                                        </button>
                                    </form>
                                @else
                                    <button  class="cursor-not-allowed bg-green-300 rounded rounded-xl p-2 text-black">
                                        Produit(s) rendu(s)
                                    </button>
                                @endif
                            </th>
                        </tr>
                        </thead>
                        @foreach($order->rentables as $rentable)
                        <tbody>
                            <tr>
                                <td class="w-32 h-32">
                                    <img src="{{ asset($rentable->image) }}" alt="object-contain">
                                </td>
                                <td> Produit : {{ $rentable->name }}</td>
                                <td> quantité(s) : {{ $rentable->pivot->quantity }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
            @empty
                <p class="text-gray-400 mb-4">Aucune location trouvée</p>
            @endforelse
        </div>
        <div class="w-full ml-96">
            {{$orders->links()}}
        </div>
    </div>

    <script>

        const detailsButton = document.querySelectorAll('#detailsButton')
        detailsButton.forEach(function (button){
            button.addEventListener('click', function(){
                let orderRow = button.closest('tr'),
                    detailsModal = document.querySelector("#detailsModal");

                let lendId = orderRow.querySelector("#id").innerText.trim();
                let lend = orderRow.querySelector("#orderedOn").innerText.trim();
                let comeback = orderRow.querySelector("#comebackDate").innerText.trim();
                let sttus = orderRow.querySelector("#orderStatus").innerText.trim();

                detailsModal.querySelector("#lendId").textContent = lendId;
                detailsModal.querySelector("#ordered_on").textContent = lend;
                detailsModal.querySelector("#comeback_on").textContent = comeback;
                detailsModal.querySelector("#status").textContent = sttus;
            })
        })

    </script>

</x-clear-layout>

