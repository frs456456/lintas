<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenance";
    protected $fillable = ["id_pegawai","id_handphone","keterangan","id_pegawai_sebelumnya","fisik","fungsi","m_imei"];
    
    public function handphone()
    {
        return $this->belongsTo('App\Models\Handphone', 'id_handphone');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','id_pegawai');
    }
}
