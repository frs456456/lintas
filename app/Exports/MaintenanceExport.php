<?php

namespace App\Exports;

use App\Models\Inventaris;
use App\Models\Maintenance;
use App\Models\Pegawai;
use App\Models\Handphone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MaintenanceExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
       return Maintenance::select('id_pegawai','id_handphone','keterangan','id_pegawai_sebelumnya','tgl_maintenance')->get();
      
    }


    public function map($maintenance): array{
        return[
            $maintenance->pegawai->nama,
            $maintenance->handphone->merk,
            $maintenance->handphone->tipe,
            $maintenance->handphone->warna,
            $maintenance->handphone->imei1,
            $maintenance->keterangan,
            $maintenance->id_pegawai_sebelumnya,
            $maintenance->tgl_maintenance
        ];
    }

    public function headings(): array

    {

        return [

            'Nama Pegawai',
            'Merk HP',
            'Type',
            'Warna',
            'Imei1',
            'Keterangan',
            'Pegawai Sebelumnya',
            'Tgl Maintenance',
        ];
    }
}
