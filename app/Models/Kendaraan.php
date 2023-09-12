<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = "kendaraan";
    protected $fillable = ["jenisKendaraan", "noPolisi", "noMesin", "noRangka", "merek","warna","status"];
    
    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}
