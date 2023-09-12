<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = "inv_hp";

    protected $fillable = ["nama", "no_hp", "jabatan", "area", "warna","imei", "serial_number", "kd_inventaris","wilayah","imei_baru","tgl_maintenance"];

}
