<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Materiel extends Model
{
    protected $table = 'materiel';
    protected $fillable = ['id','nom','durer'];
    public $timestamps = false;

    public static function SaveMateriel($nom,$durer)
    {
        try {
            $materiel = new Materiel();
            $materiel->nom = $nom;
            $materiel->durer = $durer;
            $materiel->save();
            return $materiel;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    public static function MaterielProvince($province)
    {
        try {
            $materiels = DB::table('v_don')
                ->where('id_materiel','>',1)
                ->where('province', '=', $province)
                ->get();
            return  $materiels;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    use HasFactory;
}
