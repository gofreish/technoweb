<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nos repas') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">
         <div class="bg-slate-200 mt-5 border-2 border-slate-400 rounded-lg p-6 mt-4">
            <div class="text-center text-2xl underline">Editer le repas {{$repas->nom}}</div>
            <form class="mt-4" method="post" action="{{route('repas.update', ['repa' => $repas->id])}}" >
                @method("PATCH")
                @csrf
                <div class="border-b border-gray-400 rounded p-2">
                    <label class="text-lg mr-2" for="nom">Nom : </label>
                    <input required class="border-none font-bold italic" value="{{$repas->nom}}" type="text" name="nom" id="nom">
                </div>
                <div class="mt-2 border-b border-gray-400 rounded p-2">
                    <label class="text-lg mr-2" for="prix">Prix : </label>
                    <input required class="border-none font-bold italic" value="{{$repas->prix}}" type="number" name="prix" id="prix">
                </div>
                <div class="mt-2  border-b border-gray-400 rounded p-2">
                    <label class="text-lg mr-2" for="nbr_dispo">Nombre de plats : </label>
                    <input class="border-none font-bold italic" value="{{$repas->nbr_dispo}}" type="number" name="nbr_dispo" id="nbr_dispo">
                </div>
                <div class="flex justify-between mt-4 px-4">
                    <a href="{{route('repas.index')}}" class="transition ease-in-out px-2 py-1 border border-red-500 rounded bg-red-400 hover:-translate-y-1 hover:scale-110 hover:text-white hover:bg-red-600 duration-300">Annuler</a>
                    <button type="submit" class="transition ease-in-out px-2 py-1 border border-green-500 rounded bg-green-400 hover:-translate-y-1 hover:scale-110 hover:text-white hover:bg-green-600 duration-300">Valider</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>