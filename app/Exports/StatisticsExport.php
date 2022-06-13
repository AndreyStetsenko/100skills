<?php

namespace App\Exports;

use App\Models\Statistics;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatisticsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Statistics([
            [1, 2, 3],
            [4, 5, 6]
        ]);
    }
}
