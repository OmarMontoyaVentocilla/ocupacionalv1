<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Triaje extends Model
{
     protected  $table='triajes';
     protected  $fillable=['idcomprobante','idpaciente','iddoctor','fecha','sistolica','diastolica','fcardiaca',
                           'fcrespiratoria','sto2','talla','peso','imc','pabodminal','pte','pti','temperatura',
                           'cintura','pcadera','icc','ptoraxico','atendido','revisado','auditado','estado'                       
                          ];
}
