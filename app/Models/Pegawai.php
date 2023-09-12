<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $fillable = ["nip", "nama", "divisi", "bagian","jabatan"];

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}
