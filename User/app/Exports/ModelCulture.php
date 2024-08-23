<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModelCulture implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(array $data)
    {
        $this->data = collect($data); // Transforme en collection
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array{
        return ['nom', 'prix_unitaire','sol'];
    }
}
