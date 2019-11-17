<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
   protected $table='specialties';
   protected $fillable=['id','nombre_esp','estado'];

   public function equips(){
       return $this->hasMany('App\Equip','specialties_id','id');
   }


}
