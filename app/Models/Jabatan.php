<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "jabatan";
    protected $fillable = ["nm_jabatan"];

    public function arsip()
    {
        return $this->hasMany('App\Arsip');
    }
}
