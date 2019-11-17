<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dermatologia extends Model
{
     protected $table='dermatologies';
     protected $fillable = ['id', 'idcomprobante', 'idpaciente','iddoctor','fecha','opcion1','respuesta_opcion1',
                            'opcion2', 'respuesta1_opcion2', 'respuesta2_opcion2','opcion3','opcion4','opcion5',
                            "respuesta_opcion5","opcion6","respuesta_opcion6","opcion7","respuesta_opcion7","opcion8",
                            "opcion9","respuesta_opcion9","opcion10","opcion11","opcion12","respuesta_opcion12",
                            "opcion13","opcion14","opcion15","respuesta_opcion16","respuesta_opcion17","opcion18","opcion19",   
                            "opcion20","conclusiones","cabeza","tronco","extremidades","wood","nokolsky","descripcion",
                            "atendido","revisado","auditado","estado"];
}
