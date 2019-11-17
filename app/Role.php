<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Spatie_r;

class Role extends Spatie_r
{
    protected  $table='roles';
    protected  $fillable=['name','guard_name','estado'];
}
