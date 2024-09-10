<?php

namespace App\Http\Controllers;

use App\Exports\AllMaterielExport;
use App\Exports\ArgentExport;
use App\Exports\MaterielExport;
use App\Exports\MaterielProvince;
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
            if(Auth::user()->usertype == 1){
                $materiels = DB::table('v_don')->where('id_materiel','=',$id)->where('province','=',Auth::user()->province)->get();
                return view('DetailsMateriel')->with('materiels', $materiels);
            }
            $materiels = DB::table('v_don')->where('id_materiel','=',$id)->get();
            return view('DetailsMateriel')->with('materiels',$materiels);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour afficher toures les cultures de la province
    public function MaterielAll()
    {
        try {
            $province = DB::table('province')->get();
            if (Auth::user()->usertype == 1){
                $materiels = DB::table('v_don')
                    ->where('id_materiel','>',1)
                    ->where('province','=',Auth::user()->province)
                    ->get();
                return view('MaterielListeAll')->with('materiels', $materiels)->with('provinces', $province);
            }
            $materiels = DB::table('v_don')
                ->where('id_materiel','>',1)
                ->get();
            return view('MaterielListeAll')->with('materiels', $materiels)->with('provinces', $province);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour afficher toures les cultures de la province
    public function MaterielAllPDF()
    {
        try {
            if (Auth::user()->usertype == 1){
                $materiels = DB::table('v_don')
                    ->where('id_materiel','>',1)
                    ->where('province','=',Auth::user()->province)
                    ->get();
                return view('pdfMateriels')->with('materiels', $materiels);
            }
            $materiels = DB::table('v_don')
                ->where('id_materiel','>',1)
                ->get();
            return view('pdfMateriels')->with('materiels', $materiels);
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

    //fonction pour telecharger l'export Excel des materiaux par province
    public function MaterielExportProvince($ids)
    {
        try {
            // Convertir la chaîne d'IDs en tableau
            $idsArray = explode(',', $ids);

            // Récupérer les noms des provinces sélectionnées
            $provinces = DB::table('province')
                ->whereIn('id', $idsArray)
                ->pluck('nom')
                ->toArray();

            // Générer le nom de fichier avec les noms des provinces
            $date = Carbon::now()->format('d-m-Y-H-i-s');
            $provinceNames = implode('_', $provinces);
            $excel = 'Materiels_export_'.$provinceNames.'_'.$date.'.xlsx';

            // Exporter les données
            return Excel::download(new MaterielProvince($idsArray), $excel);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    //fonction pour faire un export complet de tout les materiel
    public function MaterielAllExport()
    {
        try {
            return Excel::download(new AllMaterielExport(),'Materiels_export.xlsx');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour exporter en feuilles excel les dons d'argent
    public function ArgenExport()
    {
        try {
            return Excel::download(new ArgentExport(),'Argents_export.xlsx');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher les materiaux par province
    public function MaterielProvince(Request $request)
    {
        try {
            // Validation pour s'assurer qu'au moins une province est sélectionnée
            $request->validate([
                'province' => 'required|array', // 'province' doit être un tableau
//                'province.*' => 'exists:province,id' // chaque élément du tableau doit exister dans la table 'province'
            ]);

            // Récupérer les provinces sélectionnées
            $selectedProvinces = $request->input('province'); // Tableau des provinces sélectionnées

            // Récupérer toutes les provinces pour la vue
            $provinces = DB::table('province')->get();

            // Récupérer les matériels correspondant aux provinces sélectionnées
            $materiels = DB::table('v_don')
                ->where('id_materiel', '>', 1)
                ->whereIn('province', $selectedProvinces) // Utilisation de whereIn pour plusieurs provinces
                ->get();

            // Récupérer les noms des provinces sélectionnées pour les afficher
            $selectedProvinceNames = DB::table('province')
                ->whereIn('id', $selectedProvinces)
                ->pluck('nom'); // Liste des noms de provinces sélectionnées

            // Retourner la vue avec les données nécessaires
            return view('MaterielProvince', [
                'materiels' => $materiels,
                'provinces' => $provinces,
                'select' => $selectedProvinces, // Passer le tableau des provinces sélectionnées
                'selectedProvinceNames' => $selectedProvinceNames // Noms des provinces sélectionnées
            ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    // Fonction pour récupérer le PDF des matériels par provinces
    public function MaterielPdfProvince($ids)
    {
        try {
            // Convertir la chaîne d'IDs en tableau
            $idsArray = explode(',', $ids);

            // Récupérer les matériels des provinces sélectionnées
            $materiels = DB::table('v_don')
                ->where('id_materiel', '>', 1)
                ->whereIn('province', $idsArray)
                ->get();

            // Récupérer les noms des provinces sélectionnées
            $provinces = DB::table('province')
                ->whereIn('id', $idsArray)
                ->pluck('nom');

            return view('pdfMaterielsProvince')
                ->with('materiels', $materiels)
                ->with('provinces', $provinces);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}
