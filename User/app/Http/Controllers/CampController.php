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
            return view('CampDetails')->with('camps',$camp)->with('cultures',$culture)->with('colabs',$colabs);
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
            $request->validate([
                'id' => 'required',
                'colab' => 'required',
                'debut' => 'required',
                'fin' => 'nullable',
                'details' => 'nullable',
            ]);

            Camp::CampCollab(\request('id'),\request('colab'),\request('details'),\request('debut'),\request('fin'));

            return redirect()->back()->with('success', 'Collaborateur assigné avec succès');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire de don
    public function Dons(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'materiel' => 'required',
                'colab' => 'required',
                'qte' => 'required',
                'date' => 'required',
            ]);

            Camp::Dons(\request('id'),\request('materiel'),\request('colab'),\request('qte'),\request('date'));
            return redirect()->back()->with('success2','Don enregistrer avec succes');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher le formulaire d'ajout de culture dans les stock
    public function AddRecolte($id)
    {
        try {
            $culture = DB::table('v_campculture')->where('id_camp','=',$id)->get();
            return view('AddRecolte')->with('cultures',$culture);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'enregistrenent de recolte
    public function SaveRecolte(Request $request)
    {
        try {
            request()->validate([
                'camp' => 'required',
                'culture' => 'required',
                'quantite' => 'required',
                'date' => 'required',
            ]);
            Camp::SaveRecolte(\request('camp'),\request('culture'),\request('quantite'),\request('date'));
            return redirect()->back()->with('success','Recolte enregistrer avec succes');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher le calendrier de recolte
    public function Recolte()
    {
        try {
            $recoltes = DB::table('etatstock')->where('etat','=',0)->get();
            return view('Recolte')->with('recoltes',$recoltes);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
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
}
