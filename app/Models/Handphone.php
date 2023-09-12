<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handphone extends Model
{
    protected $table = "handphone";

    public function maintenance()
    {
        return $this->hasMany('App\Maintenance');
    }

}
