<x-layout>
    <p class="text-2xl">Mes articles :</p>
    <div class="gap-2 flex flex-col">
        @foreach($items as $item)
            <div class="w-[600px] h-[200px] border-black border flex rounded-lg overflow-hidden">

                <img src="{{$item->image}}" class="w-auto h-full" alt="">
                <div class="flex flex-col p-4 w-full">
                    <p class="text-xl">{{$item->name}}</p>

                    <div class="flex justify-between">
                        <div class="flex justify-center items-center">
                            <p>Quantité : {{$item->quantity}}</p>
                        </div>
                        <div class="flex justify-center items-center">
                            <form action="{{ route('addQuantityToProduct') }}" method="POST" class="flex justify-center items-center">
                                @csrf
                                <input type="text" name="product_to_add" value="{{ $item->rentable }}" hidden>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('removeQuantityToProduct') }}" method="POST" class="flex justify-center items-center">
                                @csrf
                                <input type="text" name="product_to_remove" value="{{ $item->rentable }}" hidden>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('cart.remove-product') }}" method="POST" class="flex justify-center items-center">
                                @csrf
                                <input type="text" name="product_to_remove" value="{{ $item->rentable }}" hidden>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        @endforeach
    </div>
</x-layout>
