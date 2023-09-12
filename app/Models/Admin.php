<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";

    protected $fillable = ["divisi", "jumlahpegawai", "jus_ke"];


    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }
}
