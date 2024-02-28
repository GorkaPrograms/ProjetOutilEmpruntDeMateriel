<x-layout>
    <div class="flex flex-col justify-center items-center">
        @if (session('error'))
            <div class="w-full p-4 bg-red-600 alert alert-success flex justify-center items-center rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        <!-- admin-password-verification.blade.php -->
        <form method="POST" action="{{ route('admin.verify.password') }}" class="flex flex-col justify-center items-center">
            @csrf
            <label for="admin_password">Entrez le mot de passe administrateur</label>
            <input id="admin_password" type="password" name="admin_password" class="rounded-md m-5 bg-stone-100 border-2 border-stone-400">
            <button type="submit">Valider</button>
        </form>
    </div>
</x-layout>
