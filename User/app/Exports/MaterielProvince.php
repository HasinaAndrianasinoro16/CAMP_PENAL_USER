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
    protected $province;
    public function __construct($province){
        $this->province = $province;
    }

    public function collection()
    {
        return DB::table('v_don')
            ->where('id_materiel','>',1)
            ->where('province', '=', $this->province)
            ->select(['materiel', 'colab', 'camp', 'quantite', 'datedon'])
            ->get();
    }

    public function headings(): array
    {
        // Définir les en-têtes des colonnes si nécessaire
        return ['Materiel', 'Donneur', 'Camp','quantite','Date d\' obtention']; // Remplacez par les noms de vos colonnes
    }
}
