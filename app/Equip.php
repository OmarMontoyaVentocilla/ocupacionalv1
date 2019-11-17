<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{

protected $table="equips";
protected $fillable=['id','descripcion_equipo','estado','modelo','marca','nro_serie','fecha_calibracion','specialties_id'];

public function speciality(){
    return $this->belongsTo('App\Speciality','specialties_id');
}


}


