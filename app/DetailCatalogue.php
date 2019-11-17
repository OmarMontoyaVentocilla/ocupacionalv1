<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCatalogue extends Model
{
    protected $table = 'detailcatalogues';

	protected $fillable = ['id', 'catalogue_id','examens_id','inscrito','estado'];
   
}
