<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $table = 'pacients';
    protected $fillable = ['id', 'hc', 'tipo_documento','nro_documento','ap_paterno','ap_materno',
                        'nombres','sexo','fecha_nacimiento','edad',
                        'telefono','estado_civil','grado_instruccion','pais_residenciaactual_id',
                        'departament_residenciaactual_id',
                        'province_residenciaactual_id','distrit_residenciaactual_id','direccion_residenciaactual',
                        'pais_nacimiento_id',
                        'departament_nacimiento_id','province_nacimiento_id','distrit_nacimiento_id','direccion_nacimiento',
                        'estado'];
}
