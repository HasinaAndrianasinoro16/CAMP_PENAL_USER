<?php

namespace App\Http\Controllers;

use App\Exports\MaterielExport;
use App\Models\Materiel;
use Couchbase\WatchQueryIndexesOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
           if(Auth::user()->usertype == 1){
               $materiel = DB::table('v_materiel')->where('id_materiel','>',1)->where('province','=',Auth::user()->province)->get();
               return view('MaterielListe')->with('materiels', $materiel);
           }
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
            if (Auth::user()->usertype == 1){
                $argent = DB::table('v_don')->where('id_materiel','=',1)->where('province','=',Auth::user()->province)->get();
                return view('ArgentListe')->with('materiels',$argent);
            }
            $argent = DB::table('v_don')->where('id_materiel','=',1)->get();
            return view('ArgentListe')->with('materiels',$argent);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour l'export controller
    public function MaterielExport($id)
    {
        try {
            $nom = DB::table('materiel')->where('id','=',$id)->value('nom');
            $date = Carbon::now()->format('d-m-Y-H-i-s');
            $excel = 'Materiels_export_'.$nom.'_'.$date.'.xlsx';
            return Excel::download(new MaterielExport($id), $excel);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
