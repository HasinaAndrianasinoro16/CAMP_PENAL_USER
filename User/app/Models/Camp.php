<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Camp extends Model
{

    //fonction pour assigner un collaborateur a un camp penal
    public static function CampCollab($camp, $colab, $details, $debut, $fin)
    {
        try {
            $insert = DB::table('campcollab')
                ->insert([
                    'camp' => $camp,
                    'collaborateur' => $colab,
                    'details' => $details,
                    'debut' => $debut,
                    'fin' => $fin
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour faire un ajout de don a un camp penal
    public static function Dons($camp, $materiel, $colab, $montant, $envoie)
    {
        try {
            $insert = DB::table('don')
                ->insert([
                    'camp' => $camp,
                    'collaborateur' => $colab,
                    'materiel' => $materiel,
                    'quantite' => $montant,
                    'datedon' => $envoie
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer une recolte
    public static function SaveRecolte($camp, $culture, $quantite, $date, $prisonier)
    {
        try{
            $insert = DB::table('stockculture')
                ->insert([
                    'camp' => $camp,
                    'culture' => $culture,
                    'quantite' => $quantite,
                    'datestock' => $date,
                    'etat' => 0,
                    'prisonnier' => $prisonier,
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer la nouvelle culture dans un camp
    public static function SaveCulture($camp, $culture, $supperficie)
    {
        try {
            $insert = DB::table('campculture')
                ->insert([
                    'camp' => $camp,
                    'culture' => $culture,
                    'superficie' => $supperficie
                ]);
            return $insert;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer les sortie de culture
    public static function SaveSortie($camp, $culture, $quantite, $date)
    {
        try {
            $insert = DB::table('stockculture')
                ->insert([
                    'camp' => $camp,
                    'culture' => $culture, // Assurez-vous d'insérer la culture
                    'quantite' => $quantite,
                    'datestock' => $date,
                    'etat' => 1,
                    'prisonnier' => 0
                ]);
            return $insert;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer une estimation

    public static function saveEstimation($camp, $culture, $quantite, $date,$etat)
    {
        try {
            $cultureData = DB::table('culture')->where('id', $culture)->first();

            if (!$cultureData) {
                throw new \Exception("Culture non trouvée pour l'ID donné.");
            }

            $estimation = $quantite * $cultureData->prixunitaire;

            DB::table('stock_estimation')->insert([
                'camp' => $camp,
                'culture' => $culture,
                'nom' => $cultureData->nom,
                'quantite' => $quantite,
                'estimation' => $estimation,
                'datestock' => $date,
                'etat' => $etat
            ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    use HasFactory;
}
