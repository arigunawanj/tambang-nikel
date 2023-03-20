<?php

namespace App\Imports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\ToModel;

class DriverImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Driver([
            'nama_driver' => $row[0],
            'alamat_driver' => $row[1],
            'telepon_driver' => $row[2],
        ]);
    }
}
