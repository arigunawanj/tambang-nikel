<?php

namespace App\Exports;

use App\Models\Sewa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SewaExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.sewaexport', [
            'sewa' => Sewa::all()
        ]);
    }

    
}
