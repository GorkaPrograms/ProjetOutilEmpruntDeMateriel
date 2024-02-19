<div x-show="updating === true">
    <div class="bg-black opacity-40 h-screen w-screen fixed top-0 left-0 z-10" x-on:click="updating = !updating"></div>

    <div class="bg-white absolute top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 min-w-[33.333333%] w-auto h-auto rounded-md">
        <button x-on:click="updating = !updating">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fixed top-2 right-2 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <form id="updateForm" action="{{ $action }}" method="POST" class="flex flex-col h-full w-full px-6">
            @csrf
            @method('PATCH')
            <h3 class="font-medium text-xl underline underline-offset-2 py-2">Modifier {{ $formTitle  }}</h3>
            <input name="{{ $name }}" class="bg-gray-200 min-w-1/2 max-w-auto border-2 border-gray-400 border-opacity-30 rounded-md px-2" type="text" value="{{ $placeholder }}" placeholder=" {{ $placeholder }} ">
            <button type="submit" class="min-w-fit w-1/4 px-2 py-1 bg-promeo-blue rounded-lg text-gray-50 font-bold my-4 {{--Partie hover--}} hover:bg-promeo-yellow hover:text-gray-950 transition duration-200">Apporter les modifications</button>
        </form>
    </div>
</div>
