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
            return view('CampDetails')->with('camps',$camp)->with('cultures',$culture);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
