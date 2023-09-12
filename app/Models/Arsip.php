<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = "arsip";
    protected $fillable = ["waktuUpload", "noArsip", "nama", "jenisFile", "file", "id_kategori", "id_petugas", "keterangan"];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_petugas');
    }
}
