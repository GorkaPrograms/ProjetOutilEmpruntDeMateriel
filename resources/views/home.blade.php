<x-layout>
    <div class="grid grid-cols-3 gap-5">
        @forelse($rentables as $rentable)
            <div class="col-1">
                <img src="{{ $rentable->image }}">
                <div class="flex flex-row justify-between mt-1">
                    <p class=""><strong>{{$rentable->rentable_name}}</strong></p>
                    <button class="flex flex-row p-1 rounded-md hover:bg-[#494958] hover:scale-110 hover:cursor-pointer hover:text-white ease-in-out duration-200">
                        Ajouter au panier
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </button>
                </div>
                <p>{{$rentable->total_number}} restant(s)</p>
            </div>
        @empty
            <p class="text-slate-400 text-center">Aucun résultat.</p>
        @endforelse
    </div>
    {{$rentables->links()}}
</x-layout>
