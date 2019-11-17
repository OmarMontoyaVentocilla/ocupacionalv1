<?php

namespace App\Http\Controllers;
//use App\Http\Requests\IdiomaRequest;
use App\Idiom;
use Illuminate\Http\Request;

class IdiomaController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function listar(Request $request) {
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
		$paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $idioma=Idiom::where('nombre_idioma','like','%'.$valor_caja.'%')->where('estado',1)->orderBy('id', 'DESC')->paginate($paginacion); 
        //TOTAL DE REGISTROS
        $total_registros=Idiom::where('estado',1)->count();
        //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=Idiom::where('nombre_idioma','like','%'.$valor_caja.'%')->where('estado',1)->count();
		$response = [
			'pagination' => [
				'total' => $idioma->total(),
				'current_page' => $idioma->currentPage(),
				'per_page' => $idioma->perPage(),
				'last_page' => $idioma->lastPage(),
				'from' => $idioma->firstItem(),
				'to' => $idioma->lastItem(),
			],
			'idioma' => $idioma,
			'total_registros'=>$total_registros,
			'total_reg_busqueda'=>$total_reg_busqueda,
		]; 
		return response()->json($response);
	}

	public function index() {
		$idiom = new Idiom;
		return view('idioma.index', compact('idiom'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// if ($request->ajax()) {
		// 	$idioma = new Idiom;
		// 	$idioma->fill($request->only('nombre_idioma'));
		// 	if ($idioma->save()) {
		// 		return response()->json([
		// 			"success" => true,
		// 			"mensaje" => "Se registro exitosamente",
		// 		]);
		// 	}
		// }
		
		$idiom = new Idiom;
		$idiom->nombre_idioma = $request->get('nombre_idioma');
		$idiom->estado = 1;

		if ($idiom->save()) {
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
		// $idioma = Idiom::find($id);
		// return response()->json($idioma);
		$idiom = Idiom::find($id);
		return $idiom;
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
		// if ($request->ajax()) {
		// 	$idioma = Idiom::find($id);
		// 	$idioma->nombre_idioma = $request->get('nombre_idioma');
		// 	if ($idioma->save()) {
		// 		return response()->json([
		// 			"success" => true,
		// 			"mensaje" => "Se actualizo exitosamente",
		// 		]);

		// 	}
		// }
		$idiom = Idiom::find($id);
		$idiom->nombre_idioma = $request->get('nombre_idioma_edit');

		if ($idiom->save()) {
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
	public function destroy($id) {
		$idiom = Idiom::find($id);
		$idiom->estado = 0;
		if ($idiom->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se elimino exitosamente",
			]);
		}
	    // $idioma = Idiom::find($id);
		// if ($idioma->delete()) {
		// 	return response()->json([
		// 		"success" => true,
		// 		"mensaje" => "Se elimino exitosamente",
		// 	]);
		// }
	}
}
