<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterielController extends Controller
{
    //controller pour afficher la page Materiel
    public function Materiel()
    {
        try {
            return view('Materiel');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'ajout de Materiel
    public function SaveMateriel(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required',
                'durer' => 'nullable',
            ]);
            Materiel::SaveMateriel(\request('nom'), \request('durer'));
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher les listes de materiels
    public function MaterielListe()
    {
        try {
            $materiel = DB::table('v_materiel')->get();
            return view('MaterielListe')->with('materiels', $materiel);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
