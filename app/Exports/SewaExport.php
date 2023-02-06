<?php

namespace App\Exports;

use App\Models\sewa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SewaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return sewa::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nama Customer',
            'NO. HP',
            'Tanggal Sewa',
            'Tanggal Kembali',
            'Kendaraan',
            'Driver',
            'Approval 1',
            'Approval 2',
            'Status',
        ];
    }

    public function map($sewa): array
    {
        return [
            $sewa->id,
            $sewa->nama_cust,
            $sewa->nohp,
            $sewa->tanggal_sewa,
            $sewa->tanggal_kembali,
            $sewa->kendaraan->nama_kendaraan,
            $sewa->driver->nama_driver,
            $sewa->approval1,
            $sewa->approval2,
            $sewa->status,

           
        ];
    }
}
