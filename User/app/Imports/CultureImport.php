<?php

namespace App\Imports;

use App\Models\Culture;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CultureImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $sol = DB::table('sol')
            ->where('nom', 'ILIKE', $row['sol'].'%')
            ->value('id');
        $prix = str_replace(',', '.', $row['prix_unitaire']);
        $id = Culture::getId();
        return new Culture([
            'id' => $id,
            'nom' => $row['nom'],
            'sol' => $sol,
            'prixunitaire' => $prix,
        ]);
    }
}
