<?php

namespace App\Exports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Region::all();
    }

    public function headings(): array
    {
        return [
            'COA',
            'Project',
            'Region',
            'Created At',
            'Last Update',
        ];
    }
}
