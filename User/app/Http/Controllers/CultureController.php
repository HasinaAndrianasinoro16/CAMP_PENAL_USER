<?php

namespace App\Http\Controllers;

use App\Imports\CultureImport;
use App\Models\Culture;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CultureController extends Controller
{
    //controller pour afficher la liste des cultures
    public function Culture(){
        try {
            $cultures = Culture::getCulture();
            return view('Culture')->with('cultures',$cultures);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher le formulaire d'ajout de culture
    public function NewCulture()
    {
        try {
            $sol = DB::table('sol')->get();
            return view('NewCulture')->with('sols',$sol);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour l'affichage de la page de mis a jour d'une culture
    public function updateCulture($id)
    {
        try {
            $culture = Culture::getCultureById($id);
            $sol = DB::table('sol')->get();
            return view('UpdateCulture')->with('culture',$culture)->with('sols',$sol);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour inserer la nouvelle culture
    public function AddCulture(Request $request){
        try {
            $request->validate([
                'name'=>'required',
                'prix'=>'required|numeric',
                'sol'=>'required',
            ],[
                'name.required' => 'le champ Nom ne doit pas etre vide',
                'prix.required' => 'le champ Prix ne doit pas etre vide',
                'prix.numeric' => 'le champ Prix doit etre un nombre reel ou decimal',
                'sol.required' => 'le champ Sol ne doit pas etre vide',
            ]);

            Culture::saveCulture($request->name, $request->prix, $request->sol);
            return redirect()->back()->with('success', 'Culture enregistrée avec succès');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=> 'Une erreur s\'est produite:' . $exception->getMessage()]);
        }
    }

    //controller pour le formulaire de mis a jour d'une culture

    public function FormUpdateCulture(Request $request){
        try {
            $request->validate([
                'id'=>'required',
                'name'=>'required',
                'prix'=>'required|numeric',
                'sol'=>'required',
            ],[
                'name.required' => 'le champ Nom ne doit pas etre vide',
                'prix.required' => 'le champ Prix ne doit pas etre vide',
                'prix.numeric' => 'le champ Prix doit etre un nombre reel ou decimal',
                'sol.required' => 'le champ Sol ne doit pas etre vide',
            ]);

            Culture::updateCulture($request->id, $request->name, $request->prix, $request->sol);
            return redirect()->back()->with('success', 'Culture enregistrée avec succès');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=> 'Une erreur s\'est produite:' . $exception->getMessage()]);
        }
    }

    //supprimer une culture
    public function DropCulture($id)
    {
        try {
            Culture::dropCulture($id);
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception( $exception->getMessage());
        }
    }

    //fonction pour sauvegarder des cultures depuis un fichier excel
    public function ImportCulture(Request $request)
    {
        try {
            $file = $request->file('csv_file');
            Excel::import(new CultureImport(), $file);
            return redirect()->back()->with('success','Les cultures on bien ete enregistrer');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=> 'Une erreur s\'est produite:' . $exception->getMessage()]);
        }
    }
}
