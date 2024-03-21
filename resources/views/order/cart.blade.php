<x-layout>
    <p class="text-2xl mb-2 underline underline-offset-2 font-bold">Votre panier</p>
    @if (session('outOfQuantity'))
        <div class="w-full p-4 bg-red-600 alert alert-success flex justify-center items-center rounded-lg my-4">
            <p class="text-white">{{ session('outOfQuantity') }}</p>
        </div>
    @endif
    <div class="w-full h-full flex justify-center items-start">
        <div class="gap-2 flex flex-col w-full">
            @foreach($items as $item)
                <div class="w-[600px] h-[200px] border-black border flex rounded-lg overflow-hidden bg-white shadow-md mb-2">

                    <img src="{{ asset($item->image) }}" class="w-auto h-full p-3" alt="">
                    <div class="flex flex-col p-4 w-full">
                        <p class="text-xl">{{$item->name}}</p>

                        <div class="w-full h-full flex justify-end items-center flex-col">
                            <div class="w-full flex justify-between items-center relative mb-2">
                                <div class="flex justify-center items-center">
                                    <p>Quantité : {{$item->quantity}}</p>
                                </div>
                                <div class="flex justify-center items-center gap-4">
                                    <form action="{{ route('addQuantityToProduct') }}" method="POST" class="flex justify-center items-center">
                                        @csrf
                                        <input type="text" name="product_to_add" value="{{ $item->rentable }}" hidden>
                                        <button class="rounded-full ring-[3px] ring-logo-green hover:ring-green-400 transition duration-200 p-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('removeQuantityToProduct') }}" method="POST" class="flex justify-center items-center">
                                        @csrf
                                        <input type="text" name="product_to_remove" value="{{ $item->rentable }}" hidden>
                                        <button class="rounded-full ring-[3px] ring-logo-green transition hover:ring-green-400 duration-200 p-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="w-full flex justify-end items-center">
                                <form action="{{ route('cart.remove-product') }}" method="POST" class="flex justify-center items-center">
                                    @csrf
                                    <input type="text" name="product_to_remove" value="{{ $item->rentable }}" hidden>
                                    <button class="mt-1 py-1.5 px-2 flex justify-center items-center bg-red-600 rounded-lg text-gray-50 font-bold  hover:bg-red-500 transition duration-200">
                                        Supprimer du panier
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="w-full flex justify-end items-center">
            @if(\Illuminate\Support\Facades\Session::has('rentables') && count(\Illuminate\Support\Facades\Session::get('rentables')) > 0)
                <div class="w-[300px] h-[100px] bg-white flex justify-center items-center rounded-lg flex-col border border-black p-4 gap-4">
                    <div class="w-full flex justify-start items-center">
                        <h1>Nombre d'articles : {{ count(\Illuminate\Support\Facades\Session::get('rentables')) }}</h1>
                    </div>
                    <div class="w-full flex justify-end items-center">
                        <a href="{{ route('order.order_validate') }}" class="w-fit px-8 py-1 bg-logo-green rounded-lg text-gray-50 font-bold  hover:bg-green-600 transition duration-200">
                            Valider le panier
                        </a>
                    </div>

                </div>
            @endif
        </div>
    </div>
</x-layout>
