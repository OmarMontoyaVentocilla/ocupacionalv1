<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $table = 'protocols';
    protected $fillable = ['id', 'company_id', 'subcontrata','descripcion','perfil_id','estado_protocolo',
                        'vigencia_inicial','vigencia_final','total_preocupacional','total_periodico',
                        'total_retiro','total_visita','total_reubicacion','datos_preocupacional','datos_periodico',
                        'datos_retiro','datos_visita','datos_reubicacion','codigo_protocolo','factura_protocolo','estado'];
}
