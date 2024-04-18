<x-clear-layout>
    <div class="flex flex-col justify-center items-center h-96">
        @if (session('error'))
            <div class="w-full p-4 bg-red-600 alert alert-success flex justify-center items-center rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        <!-- admin-password-verification.blade.php -->
        <div class="h-full w-full flex flex-col items-center justify-center">
            <form method="POST" action="{{ route('admin.verify.password') }}" class="flex flex-col justify-center items-center min-w-[340px]">
                @csrf
                <label for="admin_password" class="text-2xl font-bold text-gray-950/80">Espace administrateur</label>
                <input id="admin_password" placeholder="Mot de passe administrateur" type="password" name="admin_password" class="w-full text-2xl rounded-md my-5 bg-stone-100 py-2 px-4 border-2 border-stone-400">
                <button type="submit" class="text-2xl flex flex-row justify-center shadow-inner bg-stone-200 p-2 rounded-md hover:bg-[#494958] hover:scale-110 hover:cursor-pointer hover:text-white ease-in-out duration-200">S'authentifier</button>
            </form>
        </div>
    </div>
</x-clear-layout>
