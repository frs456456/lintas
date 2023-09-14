<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = "barang";
    protected $fillable = ["nama", "image", "qty"];

    public function arsip()
    {
        return $this->hasMany('App\Arsip');
    }
}
