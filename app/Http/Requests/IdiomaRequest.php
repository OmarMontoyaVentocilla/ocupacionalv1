<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdiomaRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'nombre_idioma' => 'required|min:4',
		];
	}

	public function messages() {
		return [
			'nombre_idioma' => 'El campo titulo tiene que tener 4 letras como minimo',
		];
	}
}
