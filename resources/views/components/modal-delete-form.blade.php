<div x-show="deleting === true">
    <div class="bg-black opacity-40 h-screen w-screen fixed top-0 left-0 z-10" x-on:click="deleting = !deleting"></div>

    <div class="bg-white fixed top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 min-w-[33.333333%] w-auto h-auto rounded-md">
        <button x-on:click="deleting = !deleting">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fixed top-2 right-2 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <form id="deleteForm" action="{{ $action }}" method="POST" class="flex flex-col h-full w-full">
            @csrf
            @method('DELETE')
            <h3 class="font-medium text-xl underline underline-offset-2 px-6 py-2">Supprimer {{ $name }} :</h3>
            <p class="text-lg pt-4 pb-2 px-8">Êtes vous sûr de vouloir supprimer {{ $name }} <name id="firstName"></name> <lname id="lastName"></lname> ?</p>
            <p class="text-md pb-4 px-8 opacity-70" id="isAdmin"></p>
            <div class="w-full flex justify-between px-24 mb-4">
                <button type="submit" class="w-1/4 px-8 py-1 bg-red-600 rounded-lg text-gray-50 font-bold {{--Partie hover--}} hover:bg-red-500 transition duration-200">Oui</button>
                <button type="button" class="w-1/4 px-8 py-1 bg-stone-200 rounded-lg text-gray-950 font-bold {{--Partie hover--}} hover:bg-[#494958] hover:text-gray-100 transition duration-200" x-on:click="deleting = !deleting">Non</button>
            </div>
        </form>
    </div>
</div>
