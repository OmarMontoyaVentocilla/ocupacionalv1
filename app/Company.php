<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['id', 'ruc', 'razon_social',
                           'nombre_comercial','actividad_economica','direccion',
                           'departament_id','province_id','distrit_id','rubro_mineria',
                           'rubro_contruccion','rubro_industria','rubro_comercio','rubro_banca',
                           'rubro_logistico','rubro_callcenter','rubro_otro','telefono_nro1','telefono_nro2',
                           'contacto_nr1','contacto_nro2','email_nr1','email_nr2','inicio_facturacion','corte_facturacion',
                           'envio_orden_compra','dias_credito','observacion','inscripcion','habilitar_extranet',
                           'ejecutivo_ventas','estado','pagina'
                         ];
}
