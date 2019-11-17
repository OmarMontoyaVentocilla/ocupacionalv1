<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model {
	protected $table = 'editorials';

	protected $fillable = ['id', 'nombre_editorial', 'estado'];
}
