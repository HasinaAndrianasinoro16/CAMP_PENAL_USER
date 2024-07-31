<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Couchbase\WatchQueryIndexesOptions;
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
            $materiel = DB::table('v_materiel')->where('id_materiel','>',1)->get();
            return view('MaterielListe')->with('materiels', $materiel);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher les details de la venue de chaque Materiels
    public function DetailsMateriel($id)
    {
        try {
            $materiels = DB::table('v_don')->where('id_materiel','=',$id)->get();
            return view('DetailsMateriel')->with('materiels',$materiels);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la liste des dons d'argent
    public function ArgentListe()
    {
        try {
            $argent = DB::table('v_don')->where('id_materiel','=',1)->get();
            return view('ArgentListe')->with('materiels',$argent);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
