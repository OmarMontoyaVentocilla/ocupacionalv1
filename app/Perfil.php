<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['id', 'descripcion_perfil', 'company_id','estado'];
}
