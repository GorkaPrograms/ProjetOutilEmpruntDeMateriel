<x-layout>
    <p class="text-2xl mb-4 font-bold underline underline-offset-2">Validation de votre commande</p>
    <a href="{{ route('order.cart') }}" class="px-8 py-1 bg-red-600 rounded-lg text-gray-50 font-bold  hover:bg-red-500 transition duration-200"> Revenir au panier </a>
    <div class="w-full h-[400px] flex justify-center items-center">
        <form action="{{ route('order.validateOrder',Session::get('order')) }}" method="POST" class="flex justify-center items-center gap-4 flex-col">
            @csrf
            @method('PUT')
            <div class="flex flex-col justify-center items-center">
                <label for="comeback_date" class="underline mb-4 underline-offset-2 text-lg">Sélectionner la date de retour des articles</label>
                <input type="date" name="comeback_date" id="comeback_date" class="bg-white rounded-full py-1 px-6 shadow-2xl ring-logo-green ring-[2px] hover:cursor-pointer" required>
            </div>
            <button type="submit" class="w-fit px-8 py-1.5 bg-logo-green rounded-lg text-gray-50 font-bold  hover:bg-green-600 transition duration-200">
                Louer
            </button>
        </form>
    </div>
</x-layout>
