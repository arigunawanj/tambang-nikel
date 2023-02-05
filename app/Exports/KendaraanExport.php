<?php

namespace App\Exports;

use App\Models\Kendaraan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KendaraanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kendaraan::all();
    }

    public function headings(): array
    {
        return [
            'Nama Kendaraan',
            'Jenis',
            'Konsumsi BBM',
            'Jadwal',
            'Asal',
            'Status',
        ];
    }

    public function map($kendaraan): array
    {
        return [
            $kendaraan->nama_kendaraan,
            $kendaraan->jenis,
            $kendaraan->konsumsi_bbm,
            $kendaraan->jadwal,
            $kendaraan->asal,
            $kendaraan->status,
        ];
    }

    public function styles(Worksheet $outlet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
            },
        ];
    }
}
