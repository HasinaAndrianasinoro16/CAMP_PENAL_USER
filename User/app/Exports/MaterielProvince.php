<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterielProvince implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $provinces;
    public function __construct($provinces){
        $this->provinces = $provinces;
    }

    public function collection()
    {
        // Récupérer les matériels des provinces sélectionnées
        return DB::table('v_don')
            ->where('id_materiel', '>', 1)
            ->whereIn('province', $this->provinces)
            ->select(['materiel', 'colab', 'camp', 'quantite', 'datedon'])
            ->get();
    }

    public function headings(): array
    {
        // Définir les en-têtes des colonnes si nécessaire
        return ['Materiel', 'Donneur', 'Camp','quantite','Date d\' obtention']; // Remplacez par les noms de vos colonnes
    }
}
