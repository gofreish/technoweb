<?php

namespace App\Http\Controllers;

use App\Models\Repas;
use Illuminate\Http\Request;

class RepasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repas = Repas::all();
        return view("repas.index", ['repas' => $repas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("repas.new");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $repas = Repas::create([
            "nom" => $request->nom,
            "prix" => $request->prix,
             "nbr_dispo" => $request->nbr_dispo
        ]);
        return redirect()->route('repas.index')->with("success", "Repas ".$request->nom." ajouté avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(Repas $repas)
    {
        //
        dd("show");
        return view("repas.edit");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repas $repa)
    {
        //
        return view("repas.edit", ["repas" => $repa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repas $repa)
    {
        $repa->nom = $request->nom;
        $repa->prix = $request->prix;
        $repa->nbr_dispo = $request->nbr_dispo;
        $repa->save();
        return redirect()->route('repas.index')->with("success", "Repas ".$request->nom." modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repas $repa)
    {
        $msg = "Repas ".$repa->nom." supprimé avec succès";
        Repas::destroy($repa->id);
        return redirect()->route('repas.index')->with("success", $msg);
    }
}
