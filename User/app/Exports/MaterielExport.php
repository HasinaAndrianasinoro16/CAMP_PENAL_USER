<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterielExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return DB::table('v_don')
            ->where('id_materiel', '=', $this->id)
            ->select(['materiel', 'colab', 'camp', 'quantite', 'datedon'])
            ->get();
    }


    public function headings(): array
    {
        // Définir les en-têtes des colonnes si nécessaire
        return ['Materiel', 'Donneur', 'Camp','quantite','Date d\' obtention']; // Remplacez par les noms de vos colonnes
    }
}
