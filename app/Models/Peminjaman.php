<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = "peminjaman";
    protected $fillable = ["tanggal","noForm","id_pegawai","id_kendaraan","namaSupir","disetujuiOleh","lamaPinjam","keperluan","status","tgl_kembali","terlambat","kmAwal","kmAkhir","foto_kmawal","foto_kmakhir"];


    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai');
    }

    public function kendaraan()
    {
        return $this->belongsTo('App\Models\Kendaraan', 'id_kendaraan');
    }
    public function kendaraan_satpam()
    {
        return $this->hasMany('App\Kendaraan_satpam');
    }

  
}
