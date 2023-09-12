<?php

namespace App\Exports;

use App\Models\Inventaris;
use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarisExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventaris::allFields()->except('id');
    }

    public function headings(): array

    {

        return [

            'No',
            'Nama Pegawai',
            'No HP',
            'Jabatan',
            'Area',
            'Warna',
            'Imei',
            'Serial Number',
            'Kode Inventaris',
            'Wilayah',
            'IMEI Baru',
            'Tgl Maintenance',
            'Keterangan',
            'Created At',
            'Updated At',
            
        ];
    }
}
