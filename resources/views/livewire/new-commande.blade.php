<div class="mt-5 flex justify-center">
    <div class="w-96 bg-white opacity-90 border-2 border-slate-700 rounded-md p-4">
        <div class="border-b border-gray-400 rounded p-2">
            <label class="text-lg mr-2" for="nom">Nom : </label>
            <span class="font-bold italic">{{$username}}</span>
        </div>
        <div class="border-b border-gray-400 rounded p-2">
            <label class="text-lg mr-2" for="repas">Repas : </label>
            <select wire:model.live="selectedRepas" name="repas" id="repas">
                <option value=-1>Choisissez un repas</option>
                @foreach ($repas as $index => $rep)
                <option wire:key="{{ $rep->id }}" value={{$index}}>
                    <span class="font-bold">{{$rep->nom}} ({{$rep->prix}} f) {{$rep->nbr_dispo}} plats restant </span> 
                </option>
                @endforeach
            </select>
        </div>
        <div class="mt-5 relative border border-slate-400 rounded-md p-4">
            <span class="absolute -top-2 -left-2 bg-white font-bold">Votre commande</span>
            <ul>
                @foreach ($commandeList as $index => $rep)
                <li wire:key="{{ $index }}" class="flex justify-between mb-2"> 
                    <div>
                        <span class="font-bold">{{$rep['nom']}}</span> ( {{$rep["prix"]}} )
                        <input wire:change.live="calculateTotalRepas" class="w-24 border border-black" type="number" wire:model.live="commandeList.{{$index}}.nbr" min="1" max="{{$rep['dispo']}}">
                        plat(s)
                    </div>
                    <button wire:click="removePlat({{$index}}, {{$rep['id']}})" type="submit" class="transition ease-in-out px-2 py-1 border border-red-500 rounded bg-red-400 hover:-translate-y-1 hover:scale-110 hover:text-white hover:bg-red-600 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </button>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="border-b border-gray-400 rounded p-2">
            <label class="text-lg mr-2" for="livraison">Livraison : </label>
            <input wire:model.live="livraison" class="scale-125" type="checkbox" name="livraison" id="livraison">
            <span class="text-lg font-bolder">+500 f</span>
        </div>
        <div class="border-b border-gray-400 rounded p-2">
            <label class="text-lg mr-2" for="date_livraison">Jour de livraison : </label>
            <input wire:model.live="dateLivraison" class="scale-125" type="date" name="date_livraison" id="date_livraison">
        </div>
        <div class="border-b border-gray-400 rounded p-2">
            Total: <span class="text-lg font-bold">{{$total}}</span>
        </div>
        <div class="mt-4 flex justify-between">
            <!-- wire:click="enregistrer" -->
            <a href="/" class="transition ease-in-out px-2 py-1 border border-green-500 rounded bg-green-400 hover:-translate-y-1 hover:scale-110 hover:text-white hover:bg-green-600 duration-300">Enregistrer</a>
            <button wire:click="vider" class="transition ease-in-out px-2 py-1 border border-red-500 rounded bg-red-400 hover:-translate-y-1 hover:scale-110 hover:text-white hover:bg-red-600 duration-300">Annuler</button>
        </div>
        <div></div>
    </div>
</div>
 