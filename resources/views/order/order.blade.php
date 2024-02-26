<x-layout>
    <p class="text-2xl">Validation de votre commande</p>
    <div class="w-full h-[400px] flex justify-center items-center">
        <form action="{{ route('order.validateOrder',Session::get('order')) }}" method="POST" class="flex justify-center items-center gap-4 flex-col">
            @csrf
            @method('PUT')
            <div class="flex flex-col justify-center items-center">
                <label for="comeback_date">Date de retour des articles</label>
                <input type="date" name="comeback_date" id="comeback_date" required>
            </div>
            <button type="submit" class="flex justify-center iems-center py-1 px-4 bg-green-500 rounded-lg">
                Louer
            </button>
        </form>
    </div>
</x-layout>
