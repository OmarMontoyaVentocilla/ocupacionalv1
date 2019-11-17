<?php

namespace App\Http\Controllers;

use App\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct() {
		// $this->middleware('auth',['except'=>'index']);
		$this->middleware('auth');
	}

	public function listar(Request $request) {
		$paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
		$paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $editorial=Editorial::where('nombre_editorial','like','%'.$valor_caja.'%')->where('estado',1)->orderBy('id', 'DESC')->paginate($paginacion); 
        //TOTAL DE REGISTROS
        $total_registros=Editorial::where('estado',1)->count();
        //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=Editorial::where('nombre_editorial','like','%'.$valor_caja.'%')->where('estado',1)->count();
		$response = [
			'pagination' => [
				'total' => $editorial->total(),
				'current_page' => $editorial->currentPage(),
				'per_page' => $editorial->perPage(),
				'last_page' => $editorial->lastPage(),
				'from' => $editorial->firstItem(),
				'to' => $editorial->lastItem(),
			],
			'editorial' => $editorial,
			'total_registros'=>$total_registros,
			'total_reg_busqueda'=>$total_reg_busqueda,
		]; 
		return response()->json($response);

	}

	public function index() {
		$editorial = new Editorial;
		return view('editorial.index', compact('editorial'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// $rules = [
		// 	'nombre_editorial' => 'required|min:10',
		// ];
		// $message = [
		// 	'nombre_editorial.required' => 'Agregue nombre',
		// 	'nombre_editorial.min' => 'Solo agrega 10 caracteres',
		// ];

		// $this->validate($request, $rules, $message);

		$editorial = new Editorial;
		$editorial->nombre_editorial = $request->get('nombre_editorial');
		$editorial->estado = 1;
		if ($editorial->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se registro exitosamente",
			]);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$editorial = Editorial::find($id);
		return $editorial;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// $rules = [
		// 	'nombre_editorial' => 'required|min:10',
		// ];
		// $message = [
		// 	'nombre_editorial.required' => 'Agregue nombre',
		// 	'nombre_editorial.min' => 'Solo agrega 10 caracteres',
		// ];

		// $this->validate($request, $rules, $message);
		$editorial = Editorial::find($id);
		$editorial->nombre_editorial = $request->get('nombre_editorial_edit');

		if ($editorial->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se actualizo exitosamente",
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$editorial = Editorial::find($id);
		$editorial->estado = 0;
		if ($editorial->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se elimino exitosamente",
			]);
		}
		// if ($editorial->delete()) {
		//  return response()->json([
		//      "success" => true,
		//      "mensaje" => "Se elimino exitosamente",
		//  ]);
		// }

	}
}
