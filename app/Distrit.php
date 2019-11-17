<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrit extends Model
{
    protected $table='distrits';
    protected $fillable=['id','nombre_distrito','provinces_id','departaments_id'];
}
