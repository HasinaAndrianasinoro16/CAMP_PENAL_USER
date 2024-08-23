<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllMaterielExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->usertype == 1){
            return DB::table('v_don')
                ->where('id_materiel','>',1)
                ->where('province','=',Auth::user()->province)
                ->select(['materiel', 'colab', 'camp', 'quantite', 'datedon'])
                ->get();
        }
        return DB::table('v_don')
            ->where('id_materiel','>',1)
            ->select(['materiel', 'colab', 'camp', 'quantite', 'datedon'])
            ->get();
    }

    public function headings(): array{
        return ['Materiel', 'Donneur', 'Camp','quantite','Date d\' obtention']; // Remplacez par les noms de vos colonnes
    }
}
