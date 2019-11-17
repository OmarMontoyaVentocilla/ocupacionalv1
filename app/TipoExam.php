<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoExam extends Model
{
    protected $table = 'tipo_exam';
    protected $fillable = ['id', 'descripcion_ex','estado'];
}
