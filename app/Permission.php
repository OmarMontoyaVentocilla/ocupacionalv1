<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as Spatie_p;

class Permission extends Spatie_p
{
    protected  $table='permissions';
    protected  $fillable=['name','guard_name'];
}
