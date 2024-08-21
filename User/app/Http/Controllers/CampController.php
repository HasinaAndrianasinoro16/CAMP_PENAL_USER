<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CampController extends Controller
{
    //controller pour affficher la liste des camps avec la restriction des province pour le DRAP
    public function Camp()
    {
        try {
            if(Auth::user()->usertype == 1){
                $camp = DB::table('v_camp')->where('id_province','=',Auth::user()->province)->get();
                return view('Home')->with('camps',$camp);
            }
            $camp = DB::table('v_camp')->get();
            return view('Home')->with('camps',$camp);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //Controller pour afficher les details d'un camp
    public function DetailsCamp($id)
    {
        try {
            $camp = DB::table('v_camp')->where('id','=',$id)->first();
            $culture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            $colabs = DB::table('v_campcollab')->where('id_camp','=',$id)->get();
            $abouts = DB::table('about_camp')->where('id_camp','=',$id)->get();
            return view('CampDetails')->with('camps',$camp)->with('cultures',$culture)->with('colabs',$colabs)->with('abouts',$abouts);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la view Addinfo
    public function Addinfo()
    {
        try {
            $colabs = DB::table('collaborateur')->get();
            $materiel = DB::table('materiel')->get();
            return view('AddInfo')->with('colabs',$colabs)->with('materiels',$materiel);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour l'assignement d'un collaborateur
    public function CampCollab(Request $request)
    {
        try {
            // Validation des données avec messages d'erreur personnalisés
            $request->validate([
                'id' => 'required|string',
                'colab' => 'required|string',
                'debut' => 'required|date',
                'fin' => 'nullable|date|after_or_equal:debut',
                'details' => 'nullable|string',
            ], [
                'id.required' => 'Le champ ID est obligatoire.',
                'id.integer' => 'L\'ID doit être une chaine de caractere.',
                'colab.required' => 'Le champ Collaborateur est obligatoire.',
                'colab.string' => 'Le champ Collaborateur doit être une chaîne de caractères.',
                'debut.required' => 'Le champ Début est obligatoire.',
                'debut.date' => 'Le champ Début doit être une date valide.',
                'fin.date' => 'Le champ Fin doit être une date valide.',
                'fin.after_or_equal' => 'Le champ Fin doit être une date après ou égale à la date de Début.',
                'details.string' => 'Le champ Détails doit être une chaîne de caractères.',
            ]);

            Camp::CampCollab($request->input('id'), $request->input('colab'), $request->input('details'), $request->input('debut'), $request->input('fin'));

            return redirect()->back()->with('success', 'Collaborateur assigné avec succès');

        } catch (\Exception $exception) {
            // Gestion des erreurs avec un message utilisateur
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $exception->getMessage()]);
        }
    }

//    public function CampCollab(Request $request)
//    {
//        try {
//            $request->validate([
//                'id' => 'required',
//                'colab' => 'required',
//                'debut' => 'required',
//                'fin' => 'nullable',
//                'details' => 'nullable',
//            ]);
//
//            Camp::CampCollab(\request('id'),\request('colab'),\request('details'),\request('debut'),\request('fin'));
//
//            return redirect()->back()->with('success', 'Collaborateur assigné avec succès');
//        }catch (\Exception $exception){
//            throw new \Exception($exception->getMessage());
//        }
//    }

    //controller pour le formulaire de don
    public function Dons(Request $request)
    {
        try {
            // Validation des données avec messages d'erreur personnalisés
            $request->validate([
                'id' => 'required|string',
                'materiel' => 'required|string',
                'colab' => 'required|string',
                'qte' => 'required|numeric',
                'date' => 'required|date',
            ], [
                'id.required' => 'Le champ ID est obligatoire.',
                'id.integer' => 'L\'ID doit être une chaine de carctere.',
                'materiel.required' => 'Le champ Matériel est obligatoire.',
                'materiel.string' => 'Le champ Matériel doit être une chaîne de caractères.',
                'colab.required' => 'Le champ Collaborateur est obligatoire.',
                'colab.string' => 'Le champ Collaborateur doit être une chaîne de caractères.',
                'qte.required' => 'Le champ Quantité est obligatoire.',
                'qte.numeric' => 'Le champ Quantité doit être un nombre.',
                'date.required' => 'Le champ Date est obligatoire.',
                'date.date' => 'Le champ Date doit être une date valide.',
            ]);

            // Appel à la méthode Dons
            Camp::Dons($request->input('id'), $request->input('materiel'), $request->input('colab'), $request->input('qte'), $request->input('date'));

            // Redirection avec un message de succès
            return redirect()->back()->with('success2', 'Don enregistré avec succès');

        } catch (\Exception $exception) {
            // Gestion des erreurs avec un message utilisateur
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $exception->getMessage()]);
        }
    }

//    public function Dons(Request $request)
//    {
//        try {
//            $request->validate([
//                'id' => 'required',
//                'materiel' => 'required',
//                'colab' => 'required',
//                'qte' => 'required',
//                'date' => 'required',
//            ]);
//
//            Camp::Dons(\request('id'),\request('materiel'),\request('colab'),\request('qte'),\request('date'));
//            return redirect()->back()->with('success2','Don enregistrer avec succes');
//        }catch (\Exception $exception){
//            throw new \Exception($exception->getMessage());
//        }
//    }

    //controller pour afficher le formulaire d'ajout de culture dans les stock
    public function AddRecolte($id)
    {
        try {
            $culture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            $cultures = DB::table('culture')->get();
            $liste = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            return view('AddRecolte')->with('cultures',$culture)->with('cults',$cultures)->with('listes',$liste);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'enregistrenent de recolte
    public function SaveRecolte(Request $request)
    {
        try {
            $limite = 1;

            $request->validate([
                'camp' => 'required',
                'culture' => 'required',
                'quantite' => "required|numeric|min:$limite",  // Double quotes ici
                'date' => 'required|date',
                'prisonier' => "required|numeric|min:$limite",  // Double quotes ici
            ], [
                'camp.required' => 'Le champ camp est obligatoire.',
                'culture.required' => 'Le champ culture est obligatoire.',
                'quantite.required' => 'Le champ quantite est obligatoire.',
                'quantite.numeric' => 'Le champ quantite doit être un nombre.',
                'date.required' => 'Le champ date est obligatoire.',
                'date.date' => 'Le champ date doit être une date valide.',
                'prisonier.required' => 'Le champ prisonier est obligatoire.',
                'prisonier.numeric' => 'Le champ prisonier doit être un nombre.',
                'quantite.min' => "La quantité ne peut pas être inférieure à $limite.",
                'prisonier.min' => "Le nombre de prisonniers ne peut pas être inférieur à $limite.",
            ]);

            Camp::SaveRecolte($request->camp, $request->culture, $request->quantite, $request->date);
            Camp::saveEstimation($request->camp, $request->culture, $request->quantite, $request->date,0);

            return redirect()->back()->with('success', 'Récolte enregistrée avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }



    //controller pour afficher le calendrier de recolte
    public function Recolte()
    {
        try {
            if (Auth::user()->usertype == 1){
                $recoltes = DB::table('etatstock')->where('etat','=',0)->where('province','=',Auth::user()->province)->get();
                return view('Recolte')->with('recoltes', $recoltes);
            }
            $recoltes = DB::table('etatstock')->where('etat','=',0)->get();
            return view('Recolte')->with('recoltes', $recoltes);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }


    //controller pour afficher la page des details
    public function DetailsRecolte($id)
    {
        try {
            $camp = DB::table('etatstock')->where('id_stock', '=', $id)->where('etat', '=', 0)->value('camp');
            $id_camp = DB::table('etatstock')->where('id_stock', '=', $id)->where('etat', '=', 0)->value('id_camp');
            $recoltes = DB::table('etatstock')->where('id_stock','=',$id)->where('etat','=',0)->get();
            $estimation = DB::table('moyenne_stocks')->where('id_camp','=',$id_camp)->get();
            return view('DetailsRecolte')->with('recoltes',$recoltes)->with('camp',$camp)->with('estimations',$estimation);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour enregistrer les nouvelle culture dans le camp penal
    public function AddCultureCamp(Request $request)
    {
        try {
            $limite = 1;
            $request->validate([
                'camp' => 'required',
                'cultures' => 'required',
                'supperficie' => "required|numeric|min:$limite",
            ],[
                'camp.required' => 'Le champ camp est obligatoire.',
                'cultures.required' => 'Le champ cultures est obligatoire.',
                'supperficie.required' => 'Le champ superficie est obligatoire.',
                'supperficie.numeric' => 'Le champ superficie doit être un nombre.',
                'supperficie.min' => "La supperficie ne doit pas etre inferrieur $limite",
            ]);

            Camp::SaveCulture($request->camp, $request->cultures, $request->supperficie);

            return redirect()->back()->with('success2', 'Nouvelle culture enregistrée avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }


    public function dropCulture($id)
    {
        try {
            DB::table('campculture')->where('id','=',$id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //    la page d'exportation en pdf
    public function Recensement()
    {
        try {
            $abouts = DB::table('about_camp')->where('province','=',Auth::user()->province)->get();
            $total = DB::table('about_camp')->where('province','=',Auth::user()->province)->sum('total');
            $cultivable = DB::table('about_camp')->where('province','=',Auth::user()->province)->sum('cultivable');
            $ncultivable = DB::table('about_camp')->where('province','=',Auth::user()->province)->sum('ncultivable');
            return view('Recensement')->with('abouts',$abouts)->with('total',$total)->with('cultivable',$cultivable)->with('ncultivable',$ncultivable);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher la page des details des depense par camp en general
    public function Depense($id)
    {
        try {
            $years = DB::table('stockculture')
                ->selectRaw('DISTINCT EXTRACT(YEAR FROM datestock) as year')
                ->orderBy('year', 'desc')
                ->get();

            $month = DB::table('stockculture')
                ->selectRaw('DISTINCT EXTRACT(MONTH FROM datestock) as month')
                ->orderBy('month', 'desc')
                ->get();

            $donArgent = DB::table('v_don')->where('id_camp', '=', $id)->where('id_materiel', '=', 1)->get();
            $totalArgent = DB::table('v_don')->where('id_camp', '=', $id)->where('id_materiel', '=', 1)->sum('quantite');

            $estimation = DB::table('stock_estimation')->where('camp', '=', $id)->paginate(5);

            $entrer = DB::table('stock_estimation')->where('camp', '=', $id)->where('etat', '=', 0)->sum('estimation');
            $sortie = DB::table('stock_estimation')->where('camp', '=', $id)->where('etat', '=', 1)->sum('estimation');
            $totalestimation = abs($entrer - $sortie);
            $rendement = abs($totalestimation - $totalArgent);

            return view('Depense', [
                'dons' => $donArgent,
                'totaldon' => $totalArgent,
                'estimations' => $estimation,
                'totalestimation' => $totalestimation,
                'rendement' => $rendement,
                'years' => $years,
                'months' => $month
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    //fonction pour recuperer les depense d'un camp avec une date
    public function DepenseDate(Request $request)
    {
        try {
            // Validation des champs requis
            $request->validate([
                'camp' => 'required',
                'year' => 'required|integer',
                'month' => 'required|integer',
            ]);

            // Récupération des années disponibles
            $years = DB::table('stockculture')->selectRaw('DISTINCT EXTRACT(YEAR FROM datestock) as year')
                ->orderBy('year', 'desc')
                ->get();

            // Récupération des mois disponibles
            $month = DB::table('stockculture')->selectRaw('DISTINCT EXTRACT(MONTH FROM datestock) as month')
                ->orderBy('month', 'desc')
                ->get();

            // Récupération des estimations pour le camp, l'année et le mois spécifiés
            $estimations = DB::table('stock_estimation')->where('camp', '=', $request->camp)
                ->whereYear('datestock', '=', $request->year)
                ->whereMonth('datestock', '=', $request->month)
                ->get();

            // Récupération des dons en argent
            $donArgent = DB::table('v_don')->where('id_camp', '=', $request->camp)->where('id_materiel', '=', 1)
                ->whereYear('datedon', '=', $request->year)
                ->whereMonth('datedon', '=', $request->month)
                ->get();

            // Calcul du total des dons en argent
            $totalArgent = DB::table('v_don')->where('id_camp', '=', $request->camp)->where('id_materiel', '=', 1)
                ->whereYear('datedon', '=', $request->year)
                ->whereMonth('datedon', '=', $request->month)
                ->sum('quantite');

            // Calcul des entrées et sorties
            $entrer = DB::table('stock_estimation')->where('camp', '=', $request->camp)->where('etat', '=', 0)
                ->whereYear('datestock', '=', $request->year)
                ->whereMonth('datestock', '=', $request->month)
                ->sum('estimation');

            $sortie = DB::table('stock_estimation')->where('camp', '=', $request->camp)->where('etat', '=', 1)
                ->whereYear('datestock', '=', $request->year)
                ->whereMonth('datestock', '=', $request->month)
                ->sum('estimation');

            // Calcul du total des estimations et du rendement
            $totalestimation = abs($entrer - $sortie);
            $rendement = abs($totalestimation - $totalArgent);

            $nom = DB::table('camp')->where('id','=',$request->camp)->first();

            // Retour de la vue avec les données
            return view('DepenseDate', [
                'years' => $years,
                'months' => $month,
                'estimations' => $estimations,
                'camp' => $request->camp,
                'donArgent' => $donArgent,
                'totalArgent' => $totalArgent,
                'totalEstimation' => $totalestimation,
                'rendement' => $rendement,
                'nom' => $nom->nom,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    //controller pour le formulaire d'ajout de sortie de culture
    public function SortieCulture(Request $request)
    {
        try {
            // Récupération de la quantité maximale autorisée avant la validation
            $max = DB::table('v_stock')
                ->where('id_camp', '=', $request->camp)
                ->where('id_culture', '=', $request->culture)
                ->value('total'); // Utilisation de value pour récupérer directement le total

            $limite = 1;

            // Validation avec la règle personnalisée pour 'quantite'
            $request->validate([
                'camp' => 'required',
                'culture' => 'required',
                'quantite' => "required|numeric|min:$limite|max:$max",  // Utilisation de $max ici
                'date' => 'required|date',
            ], [
                'camp.required' => 'Le champ camp est obligatoire.',
                'culture.required' => 'Le champ culture est obligatoire.',
                'quantite.required' => 'Le champ quantite est obligatoire.',
                'quantite.numeric' => 'Le champ quantite doit être un nombre.',
                'date.required' => 'Le champ date est obligatoire.',
                'date.date' => 'Le champ date doit être une date valide.',
                'quantite.min' => "La quantité ne peut pas être inférieure à $limite.",
                'quantite.max' => "La quantité ne doit pas dépasser $max.",
            ]);

            Camp::SaveSortie($request->camp, $request->culture, $request->quantite, $request->date);
            Camp::saveEstimation($request->camp, $request->culture, $request->quantite, $request->date,1);

            return redirect()->back()->with('success3', 'Sortie de culture enregistrée avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }





}
