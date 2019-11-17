<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idiom extends Model {
	protected $table = 'idioms';

	protected $fillable = ['id', 'nombre_idioma','estado'];
}
