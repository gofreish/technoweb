<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Repas;
use App\Models\Commande;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NewCommande extends Component
{

    protected $debug = true;

    public $allRepas = null;
    public $repas = null;
    public $selectedRepas = -1;
    public $commandeList;
    public $total = 0;
    public $livraison = false;
    private const LIVRAISON = 500;
    private const ISWEEKEND = 1000;
    public $dateLivraison = "";
    public $username = "";

    public function mount(){
        $this->allRepas = Repas::all();
        $this->repas = $this->allRepas;
        $this->commandeList = array();
        $this->username = Auth::user()->name;
        
    }

    private function estWeekend($date)
    {
        // Conversion de la date en jour de la semaine (0 pour dimanche, 1 pour lundi, etc.)
        $jourDeSemaine = date('w', strtotime($date));
        return in_array($jourDeSemaine, [0, 6]);
    }

    public function updatedDateLivraison( $date ){
        $this->calculateTotalRepas();
        if($this->estWeekend($date))
        $this->total += self::ISWEEKEND;
    }

    public function updatedLivraison( $etat ){
        $this->calculateTotalRepas();
    }

    public function updatedSelectedRepas($index){
        //On crée le tableau associatif
        $rep = [
            "id" => $this->repas[$index]->id,
            "nom" => $this->repas[$index]->nom,
            "prix" => $this->repas[$index]->prix,
            "dispo" => $this->repas[$index]->nbr_dispo,
            "nbr" => 1
        ];
        //on ajoute a la liste des repas de a commande
        array_push($this->commandeList, $rep);
        //on recalcule le contenu du select
        $newRepasList = [];
        foreach ($this->repas as $key => $value) {
            if($value->id != $this->repas[$index]->id)
                array_push($newRepasList, $value);
        }
        $this->repas = $newRepasList;
        $this->calculateTotalRepas();
        $this->selectedRepas = -1;
    }

    public function calculateTotalRepas(){
        $total = 0;
        foreach ($this->commandeList as $key => $rep) {
            $total += $rep["prix"]*$rep["nbr"];
        }
        if( $this->livraison) $total += self::LIVRAISON;
        $this->total = $total;
    }

    public function removePlat($index, $id){
        //on retire de la liste de la commande
        Arr::pull($this->commandeList, $index);
        //on remet le repas supprimer dans la liste de selection
        foreach ($this->allRepas as $key => $repas) {
            if( $repas->id == $id ){
                array_push($this->repas, $repas);
            }
        }
        //on recalcule le total
        $this->calculateTotalRepas();
    }

    public function enregistrer(){
        dd("ok");
       $commande = null;
        if( $this->dateLivraison == "" ){
            $commande = Commande::create([
                "livraison" => $this->livraison,
                "date" => $this->dateLivraison,
                "total" => $this->total
            ]);
            foreach ($this->commandeList as $key => $repas) {
                DB::table('commande_repas')->insert([
                    'commande_id' => $commande->id,
                    'repas_id' => $repas["id"],
                    'nombre' => $repas["nbr"]
                ]); 
                $dbRepas = Repas::find($repas["id"]);
                $dbRepas->nbr_dispo -= $repas["nbr"];
                $dbRepas->save();
            }
            return redirect()->route('/');
        }
    }

    public function vider(){
        $this->repas =$this->allRepas;
        $this->selectedRepas = -1;
        $this->commandeList = array();
        $this->livraison = false;
        $this->dateLivraison = "";
        $this->calculateTotalRepas();
    }

    public function render()
    {
        return view('livewire.new-commande');
    }
}
