<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = 'obras';
    protected $fillable = ['id', 'descripcion_obra', 'company_id','estado'];
}
