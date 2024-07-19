<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CampController extends Controller
{
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
}
