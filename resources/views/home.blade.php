<x-layout>
    @if (session('outOfQuantity'))
        <div class="w-full p-4 bg-red-600 alert alert-success flex justify-center items-center rounded-lg my-4">
            <p class="text-white">{{ session('outOfQuantity') }}</p>
        </div>
    @endif
    <div class="grid grid-cols-3 gap-5">
        @forelse($rentables as $rentable)
            <div class="col-1">
                @if($rentable->image != null)
                    <img class="rounded-2xl" src="{{ $rentable->image }}">
                @else
                    <img class="min-w-full rounded-2xl" src="{{ asset('default-img.jpg') }}">
                @endif
                <div class="flex flex-row justify-between mt-1">
                    <p class=""><strong>{{$rentable->name}}</strong></p>
                    @if ($rentable->quantity > 0)
                    <form action="{{ route('cart.add-product') }}" method="post">
                        @csrf
                        <input type="text" name="product_to_add" value="{{ $rentable->id }}" hidden>
                        <button class="flex flex-row text-gray-50 shadow-inner bg-green-600 p-1 rounded-md hover:bg-green-500 hover:scale-110 hover:cursor-pointer ease-in-out duration-200">
                            Ajouter au panier
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </button>
                    </form>
                    @else
                        <button class="cursor-not-allowed flex flex-row shadow-inner bg-red-700 p-1 rounded-md gap-0.5 text-gray-50 ease-in-out duration-200">
                            Produit indisponible
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    @endif
                </div>
                @if ($rentable->quantity > 0)
                    <p>En stock</p>
                @else
                    <p>Indisponible</p>
                @endif
            </div>
        @empty
            <p class="text-slate-400 text-center">Aucun résultat.</p>
        @endforelse
    </div>
    {{$rentables->links()}}
</x-layout>
