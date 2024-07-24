<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborateur extends Model
{
    protected $table ='collaborateur';
    protected $fillable = ['id','nom'];
    public $timestamps = false;

    public static function SaveCollaborator ($nom)
    {
        try {
            $colab = new Collaborateur();
            $colab->nom = $nom;
            $colab->save();
            return $colab;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    use HasFactory;
}
