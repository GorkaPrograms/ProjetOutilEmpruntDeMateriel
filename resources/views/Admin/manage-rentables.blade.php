<x-admin-layout title="Dashboard - Articles" name="Dashboard | Gestion des articles">

    <div x-data="{deleting : false, updating: false, add: false}" class="overflow-x-hidden mt-12 flex flex-col justify-center items-center">

        <div class="mb-12 gap-96 flex justify-between items-center">
            <button type="button" x-on:click="add = !add" class="bg-stone-200 rounded-full p-1 px-3 text-lg hover:bg-[#494958] hover:text-gray-50 hover:scale-105 transition duration-200"> Ajouter un produit </button>
            {{-- Formulaire de recherche --}}
            <form action="" class="w-64 pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
                <input id="search" value="{{ request()->search }}" class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher un produit">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>

        <table class="text-left p-1 border-collapse shadow-md w-fit">
            <thead class="text-center bg-[#494958] text-gray-50 p-1">
            <tr>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer pl-2 rounded-tl-md"> Nom </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Type </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Quantité </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Date d'ajout </th>
                <th class="w-52 text-center py-2 text-lg pr-4 cursor-pointer"> Modifier </th>
                <th class="w-52 text-center py-2 text-lg cursor-pointer pr-4 rounded-tr-md"> Supprimer </th>
            </tr>
            </thead>
            <tbody>
            @forelse($rentables as $rentable)
                <tr class="odd:bg-stone-100 even:bg-stone-200">
                    <td class="py-2 pl-2 name "> {{ $rentable->name }} </td>
                    <td class="type"> {{ $rentable->type }} </td>
                    <td class="quantity"> {{ $rentable->quantity }} </td>
                    <td> Le {{ $rentable->created_at->format('d/m/Y') }} </td>
                    <td>
                        <button id="updateButton" value="{{$rentable->id }}" type="button" x-on:click="updating = !updating" class="w-full flex justify-center hover:scale-125 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                    <td>
                        <button id="deleteButton" value="{{$rentable->id }}" type="button" x-on:click="deleting = !deleting" class="w-full flex justify-center hover:scale-125 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @empty
                <p class="mb-4"> Aucun produit trouvé </p>
            @endforelse
            </tbody>
        </table>

        <div class="w-full ml-96">
        {{$rentables->links()}}
        </div>

        <x-modal-delete-form action="" name="le produit"></x-modal-delete-form>

        {{-- Formulaire de modification d'un produit --}}
        <div x-show="updating === true">
            <div class="fixed bg-gray-900 opacity-20 top-0 left-0 w-full h-full" x-on:click="updating= !updating"></div>

            <div class="bg-white fixed top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 min-w-[33.333333%] w-auto h-auto rounded-md">
                <button x-on:click="updating = !updating">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fixed top-2 right-2 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form id="updateForm" action="" method="POST" class="flex flex-col items-start h-full w-full text-lg pl-8 gap-3">
                    @csrf
                    @method('PATCH')
                    <h3 class="font-medium text-xl underline underline-offset-2 px-6 py-2">Modifier le produit</h3>
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="text" name="name" id="name" placeholder="Nom du produit">
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="text" name="type" id="type" placeholder="Type de produit">
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="number" name="quantity" id="quantity" placeholder="Quantité">
                    <label for="product_image">Image du produit</label>
                    <input id="product_image" type="file" accept="image/*">
                    <div class="w-full flex justify-between px-24 mb-4">
                        <button type="submit" class="w-fit px-8 py-1 bg-green-600 rounded-lg text-gray-50 font-bold {{--Partie hover--}} hover:bg-green-500 transition duration-200">Valider</button>
                        <button type="button" class="w-fit px-8 py-1 bg-stone-200 rounded-lg text-gray-950 font-bold {{--Partie hover--}} hover:bg-[#494958] hover:text-gray-100 transition duration-200" x-on:click="updating = !updating">Annuler</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Formulaire d'ajout d'un produit --}}
        <div x-show="add === true">
            <div class="fixed bg-gray-900 opacity-20 top-0 left-0 w-full h-full" x-on:click="add= !add"></div>

            <div class="bg-white fixed top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 min-w-[33.333333%] w-auto h-auto rounded-md">
                <button x-on:click="add = !add">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fixed top-2 right-2 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form action="{{ route('rentable.add') }}" method="POST" class="flex flex-col items-start h-full w-full text-lg pl-8 gap-3">
                    @csrf
                    @method('POST')
                    <h3 class="font-medium text-xl underline underline-offset-2 px-6 py-2">Ajouter un produit</h3>
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="text" name="name" id="name" placeholder="Nom du produit">
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="text" name="type" id=type" placeholder="Type de produit">
                    <input class="shadow-md p-1 rounded-xl bg-stone-100 min-w-[250px]" type="number" name="quantity" id=quantity" placeholder="Quantité">
                    <label for="product_image">Image du produit</label>
                    <input id="product_image" type="file" accept="image/*">
                    <div class="w-full flex justify-between px-24 mb-4">
                        <button type="submit" class="w-fit px-8 py-1 bg-green-600 rounded-lg text-gray-50 font-bold {{--Partie hover--}} hover:bg-green-500 transition duration-200">Valider</button>
                        <button type="button" class="w-fit px-8 py-1 bg-stone-200 rounded-lg text-gray-950 font-bold {{--Partie hover--}} hover:bg-[#494958] hover:text-gray-100 transition duration-200" x-on:click="add = !add">Annuler</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>

        const deleteButton = document.querySelectorAll('#deleteButton')
        deleteButton.forEach(function (button){
            button.addEventListener('click', function(){
                let id = button.value,
                    rentableRow = button.closest('tr'),
                    deleteForm = document.querySelector("#deleteForm");

                let name = rentableRow.querySelector(".name").innerText.trim();

                deleteForm.querySelector("#lastName").innerText = '"' + name + '"';
                deleteForm.querySelector("#firstName").style.display = "none"
                deleteForm.querySelector("#isAdmin").style.display = "none";
                deleteForm.action = `rentables/delete/${id}`
            })
        })


        const updateButton = document.querySelectorAll('#updateButton')
        updateButton.forEach(function (button){
            button.addEventListener('click', function (){
                let id = button.value,
                    rentableRow = button.closest('tr'),
                    updateForm = document.querySelector('#updateForm');

                let name = rentableRow.querySelector(".name").innerText.trim(),
                    type = rentableRow.querySelector(".type").innerText.trim(),
                    quantity = rentableRow.querySelector(".quantity").innerText.trim();

                updateForm.querySelector("#name").value = name;
                updateForm.querySelector("#type").value = type;
                updateForm.querySelector("#quantity").value = quantity;
                updateForm.action = `rentables/update/${id}`
            })
        })
    </script>


</x-admin-layout>
