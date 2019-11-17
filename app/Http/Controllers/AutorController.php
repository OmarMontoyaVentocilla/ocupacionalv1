<?php

namespace App\Http\Controllers;

use App\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller {
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
        $autor=Autor::where('nombre_autor','like','%'.$valor_caja.'%')->where('estado',1)->orderBy('id', 'DESC')->paginate($paginacion); 
        //TOTAL DE REGISTROS
        $total_registros=Autor::where('estado',1)->count();
        //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=Autor::where('nombre_autor','like','%'.$valor_caja.'%')->where('estado',1)->count();
		$response = [
			'pagination' => [
				'total' => $autor->total(),
				'current_page' => $autor->currentPage(),
				'per_page' => $autor->perPage(),
				'last_page' => $autor->lastPage(),
				'from' => $autor->firstItem(),
				'to' => $autor->lastItem(),
			],
			'autor' => $autor,
			'total_registros'=>$total_registros,
			'total_reg_busqueda'=>$total_reg_busqueda,
		]; 
		return response()->json($response);

	}

	public function index() {
		$autor = new Autor;
		$entero=1;
		$string="Esto es un saludo";
		$resp=	[ 
			   "entidades" =>	[ 
              		              [
              		               "id"=>1,
              		               "descripcion"=>"Mariano Melgar",
              		               "direccion"=>"jose pardo"
              		              ],
              		              [
              		               "id"=>2,
              		               "descripcion"=>"Ricardo Palma",
              		               "direccion"=>"jose pelicano"
              		              ],
              		              [
              		               "id"=>3,
              		               "descripcion"=>"Maria Arguedas",
              		               "direccion"=>"jose patria"
              		              ]
		      		            ]
		      	];
		//$resp=response()->json($entidades);
		return view('autor.index', compact('autor','resp','entero','string'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
         $total_registros=Autor::where('estado',1)->count();
         return $total_registros;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// $rules = [
		// 	'nombre_autor' => 'required|min:10',
		// ];
		// $message = [
		// 	'nombre_autor.required' => 'Agregue nombre',
		// 	'nombre_autor.min' => 'Solo agrega 10 caracteres',
		// ];

		// $this->validate($request, $rules, $message);

		$autor = new Autor;
		$autor->nombre_autor = $request->get('nombre_autor');
		$autor->estado = 1;

		if ($autor->save()) {
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
		$autor = Autor::find($id);
		return $autor;
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
		// 	'nombre_autor' => 'required|min:10',
		// ];
		// $message = [
		// 	'nombre_autor.required' => 'Agregue nombre',
		// 	'nombre_autor.min' => 'La palabra minima debe contener 10 caracteres',
		// ];

		// $this->validate($request, $rules, $message);
		$autor = Autor::find($id);
		$autor->nombre_autor = $request->get('nombre_autor_edit');

		if ($autor->save()) {
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
		$autor = Autor::find($id);
		$autor->estado = 0;
		if ($autor->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se elimino exitosamente",
			]);
		}
		// if ($autor->delete()) {
		// 	return response()->json([
		// 		"success" => true,
		// 		"mensaje" => "Se elimino exitosamente",
		// 	]);
		// }

	}
}
