<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atention extends Model
{
    protected $table = 'ordenatentions';

    protected $fillable = ['id', 'servicio','fecha','hora_inicio','nro_orden','empresa_id',
                            'area_id','profile_id','obra_id','tipoexam_id','id_subcontrata','idformato','id_paciente',
                            'subtotal','igv','total','examenes_vendidos','examenes_vendidos_precios','tipo_orden_atencion','estado'];
}
