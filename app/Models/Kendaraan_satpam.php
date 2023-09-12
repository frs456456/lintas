<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan_satpam extends Model
{
    protected $table = "kendaraan_satpam";
    public function peminjaman()
    {
        return $this->belongsTo('App\Models\Peminjaman', 'id_peminjaman');
    }
}
