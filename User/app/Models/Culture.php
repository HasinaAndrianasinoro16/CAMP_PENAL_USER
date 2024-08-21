<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Culture extends Model
{
    protected $table = 'culture';
    protected $fillable = ['nom', 'prixunitaire', 'sol'];
    public $timestamps = false;

    //fonction pour l'id automatiqur de culture
    public static function getId()
    {
        try {
            $seqvalue = DB::select("SELECT nextval('seqculture')");
            if (!empty($seqvalue)) {
                $seqvalue = $seqvalue[0]->nextval;
            } else {
                throw new \RuntimeException("Vérifiez le nom de la séquence ou si elle existe.");
            }

            return "CLT00" . $seqvalue;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour recuperer chaque culture
    public static function getCulture()
    {
        try {
            $cultures = DB::table('culture as c')
                ->join('sol as s', 's.id', '=', 'c.sol')
                ->select('c.id', 'c.nom', 'c.prixunitaire', 's.nom as sol')
                ->get();

            return $cultures;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }


    //fonction pour sauvegarder une nouvelle culture
    public static function saveCulture($nom, $prixunitaire, $sol)
    {
        try {
            $culture = new Culture();
            $culture->id = self::getId();
            $culture->nom = $nom;
            $culture->prixunitaire = $prixunitaire;
            $culture->sol = $sol;

            return $culture->save();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour recuperer une culture precise
    public static function getCultureById($id)
    {
        try {
            $culture = DB::table('culture')->where('id', $id)->first();
            return $culture;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour modifier une culture
    public static function updateCulture($id, $nom, $prixunitaire, $sol){
        try {
            $culture = DB::table('culture')->where('id', $id)
                ->update([
                    'nom' => $nom,
                    'prixunitaire' => $prixunitaire,
                    'sol' => $sol
                ]);
            return $culture;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour supprimer une culture
    public static function dropCulture($id)
    {
        try {
            $delete = DB::table('culture')->where('id', $id)->delete();
            return $delete;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    use HasFactory;
}
