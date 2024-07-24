<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollaborateurController extends Controller
{
    public function Collaborateur()
    {
        try {
            return view('Collaborator');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
