<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailExam extends Model
{
    protected $table = 'detail_exams';
    protected $fillable = ['id', 'codigo', 'descripcion','exams_id','estado'];
}
