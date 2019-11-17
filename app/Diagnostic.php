<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
 protected $table='diagnostcs';
 protected $fillable = ['id', 'descripcion', 'cie10', 'recomendaciones','estado'];
}
