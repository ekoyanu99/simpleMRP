<?php

namespace App\Exports;

use App\Models\ItemMstr;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemMstrExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ItemMstr::all();
    }
}
