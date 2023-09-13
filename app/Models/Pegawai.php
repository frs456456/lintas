<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $fillable = ["nip", "nama", "id_jabatan", "no_telp","create_at","update_at"];

    public function pegawaii()
    {
        return $this->hasMany('App\Pegawai');
    }
}
