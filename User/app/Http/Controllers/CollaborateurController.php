<?php

namespace App\Http\Controllers;

use App\Models\Collaborateur;
use Illuminate\Http\Request;

class CollaborateurController extends Controller
{
    //controller pour afficher la page Collaborator
    public function Collaborateur()
    {
        try {
            return view('Collaborator');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire d'ajout d'un nouveau collaborator
    public function SaveCollaborateur(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required | max:255',
            ]);

            Collaborateur::SaveCollaborator(\request('nom'));
            return redirect()->back();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
