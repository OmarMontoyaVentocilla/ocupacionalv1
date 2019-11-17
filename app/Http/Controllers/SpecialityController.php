<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speciality;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function especialiCombo(){
        $especialidad = Speciality::find(8);
        $equipo=$especialidad->equips;
        return $equipo;
    }

    public function querySearchSpeciality($valor_caja){
        $valor= Speciality::where('nombre_esp','like','%'.$valor_caja.'%')->where('estado',1);
        return $valor;
    }

    public function listar(Request $request){
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $especialidad=$this->querySearchSpeciality($valor_caja)
                          ->orderBy('id', 'DESC')
                          ->paginate($paginacion);


        //TOTAL DE REGISTROS
        $total_registros=Speciality::where('estado',1)->count();
        //ESPECIALIDADES
        $especialidades_combo=Speciality::select('id','nombre_esp')
                                        ->where('estado',1)
                                        ->where('id',8)
                                        ->get();
        //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=$this->querySearchSpeciality($valor_caja)
                                  ->count();

        $response = [
            'pagination' => [
                'total' => $especialidad->total(),
                'current_page' => $especialidad->currentPage(),
                'per_page' => $especialidad->perPage(),
                'last_page' => $especialidad->lastPage(),
                'from' => $especialidad->firstItem(),
                'to' => $especialidad->lastItem(),
            ],
            'especialidad' => $especialidad,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
            'especialidades_combo'=>$especialidades_combo
        ]; 


        return response()->json($response);
    }



   
     public function index()
    {
        return view('especialidad.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre_esp'        => 'required|max:100'
        ];

        $messages = [
            'nombre_esp.required'    => 'El campo especialidad es obligatorio',
            'nombre_esp.max'         => 'El campo especialidad debe tener como maximo 100 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);
        
        $especialidad= new Speciality;
        $especialidad->nombre_esp= strtoupper(request('nombre_esp'));
        $especialidad->estado='1';
          if($especialidad->save()){
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'nombre_esp'        => 'required|max:100'
        ];

        $messages = [
            'nombre_esp.required'    => 'El campo especialidad es obligatorio',
            'nombre_esp.max'         => 'El campo especialidad debe tener como maximo 100 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);


        $especialidad=Speciality::find($id);
        $especialidad->nombre_esp  = strtoupper($request->get('nombre_esp'));
        $especialidad->estado      = '1';

		if ($especialidad->save()) {
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
    public function destroy($id)
    {
        $especialidad=Speciality::find($id); 
        $especialidad->estado = 0;
        if ($especialidad->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
