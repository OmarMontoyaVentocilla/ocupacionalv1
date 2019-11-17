<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $table = 'catalogues';

	protected $fillable = ['id', 'company_id', 'estado'];
}
