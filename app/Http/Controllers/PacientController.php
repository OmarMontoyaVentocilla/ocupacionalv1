<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacient;
use App\Pais;
use App\Departament;
use Illuminate\Support\Facades\DB;


class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function querySearchPaciente($valor_caja){
        
        $valor=Pacient::select("id","hc","tipo_documento","nro_documento","ap_paterno","ap_materno","nombres",
                    "sexo","fecha_nacimiento","edad","telefono","estado_civil","grado_instruccion","pais_residenciaactual_id",
                    "departament_residenciaactual_id","province_residenciaactual_id","distrit_residenciaactual_id",
                    "direccion_residenciaactual","pais_nacimiento_id","departament_nacimiento_id","province_nacimiento_id",
                    "distrit_nacimiento_id","direccion_nacimiento", 
                    DB::raw("(CONCAT(ap_paterno,' ',ap_materno,' ',nombres)) as nombres_total")
                    )
            ->where(function($query) use($valor_caja) {
                $query->where('ap_paterno','like','%'.$valor_caja.'%')
                      ->orWhere('ap_materno', 'like','%'.$valor_caja.'%')
                      ->orWhere('nombres', 'like','%'.$valor_caja.'%')
                      ->orWhere('nro_documento', 'like','%'.$valor_caja.'%')
                      ->orWhere('hc', 'like','%'.$valor_caja.'%');
            })->where(function($query){
               $query->where('estado',1);
            });
        return $valor;
    }

    public function listar(Request $request){
       
        $paginacion = '';
		$valor_combo    = $request->get('valor_combo');
        $valor_caja    =  $request->get('valor_caja');
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $resultado=$this->querySearchPaciente($valor_caja)
                            ->orderBy('id', 'DESC')
                            ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Pacient::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchPaciente($valor_caja)
                                  ->count();

         $response = [
            'pagination' => [
                'total' => $resultado->total(),
                'current_page' => $resultado->currentPage(),
                'per_page' => $resultado->perPage(),
                'last_page' => $resultado->lastPage(),
                'from' => $resultado->firstItem(),
                'to' => $resultado->lastItem(),
                ],
                'paciente' => $resultado,
                'total_registros'=>$total_registros,
                'total_reg_busqueda'=>$total_reg_busqueda,
            ]; 
                        
        return response()->json($response);
    }

    public function index()
    {
        $pais=Pais::where('estado',1)->get(); 
        //DEPARTAMENTOS
        $departamento=Departament::select("id","nombre")->get();
        return view('paciente.index',compact('pais','departamento'));
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
        $paciente=new Pacient;
        $hc_cli = DB::table('pacients')->max('hc');
        $hc_valor=str_pad($hc_cli+1,10,"0",STR_PAD_LEFT);
        $paciente->hc=$hc_valor;
        $paciente->tipo_documento=$request->get('tipo_documento');
        $paciente->nro_documento=$request->get('num_documento');
        $paciente->ap_paterno=$request->get('ap_paterno');
        $paciente->ap_materno=$request->get('ap_materno');
        $paciente->nombres=$request->get('nombres'); 
        $paciente->sexo=$request->get('sexo');
        $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $paciente->edad=$request->get('edad');
        $paciente->pais_residenciaactual_id=$request->get('pais_actual');
        $paciente->pais_nacimiento_id=$request->get('pais_nacimiento');
        $request->get('telefono')=='' ? $paciente->telefono='' : $paciente->telefono=$request->get('telefono');
        $request->get('estado_civil')=='' ? $paciente->estado_civil='' : $paciente->estado_civil=$request->get('estado_civil');
        $request->get('grado_instru')=='' ? $paciente->grado_instruccion='' : $paciente->grado_instruccion=$request->get('grado_instru');
        $request->get('direccion_actual')=='' ? $paciente->direccion_residenciaactual='' : $paciente->direccion_residenciaactual=$request->get('direccion_actual'); 
        $request->get('departamento_actual')=='' ? $paciente->departament_residenciaactual_id='' : $paciente->departament_residenciaactual_id=$request->get('departamento_actual');
        $request->get('provincia_actual')=='' ? $paciente->province_residenciaactual_id='' : $paciente->province_residenciaactual_id=$request->get('provincia_actual');
        $request->get('distrito_actual')=='' ? $paciente->distrit_residenciaactual_id='' : $paciente->distrit_residenciaactual_id=$request->get('distrito_actual');
        $request->get('direccion_nacimiento')=='' ? $paciente->direccion_nacimiento='' : $paciente->direccion_nacimiento=$request->get('direccion_nacimiento');   
        $request->get('departamento_nacimiento')=='' ? $paciente->departament_nacimiento_id='' : $paciente->departament_nacimiento_id=$request->get('departamento_nacimiento');
        $request->get('provincia_nacimiento')=='' ? $paciente->province_nacimiento_id='' : $paciente->province_nacimiento_id=$request->get('provincia_nacimiento');
        $request->get('distrito_nacimiento')=='' ? $paciente->distrit_nacimiento_id='' : $paciente->distrit_nacimiento_id=$request->get('distrito_nacimiento');
        $paciente->estado= "1";
        if($paciente->save()){
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
        $paciente=Pacient::find($id);
        $paciente->tipo_documento=$request->get('tipo_documento');
        $paciente->nro_documento=$request->get('num_documento');
        $paciente->ap_paterno=$request->get('ap_paterno');
        $paciente->ap_materno=$request->get('ap_materno');
        $paciente->nombres=$request->get('nombres'); 
        $paciente->sexo=$request->get('sexo');
        $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $paciente->edad=$request->get('edad');
        $paciente->pais_residenciaactual_id=$request->get('pais_actual');
        $paciente->pais_nacimiento_id=$request->get('pais_nacimiento');
        $request->get('telefono')=='' ? $paciente->telefono='' : $paciente->telefono=$request->get('telefono');
        $request->get('estado_civil')=='' ? $paciente->estado_civil='' : $paciente->estado_civil=$request->get('estado_civil');
        $request->get('grado_instru')=='' ? $paciente->grado_instruccion='' : $paciente->grado_instruccion=$request->get('grado_instru');
        $request->get('direccion_actual')=='' ? $paciente->direccion_residenciaactual='' : $paciente->direccion_residenciaactual=$request->get('direccion_actual'); 
        $request->get('departamento_actual')=='' ? $paciente->departament_residenciaactual_id='' : $paciente->departament_residenciaactual_id=$request->get('departamento_actual');
        $request->get('provincia_actual')=='' ? $paciente->province_residenciaactual_id='' : $paciente->province_residenciaactual_id=$request->get('provincia_actual');
        $request->get('distrito_actual')=='' ? $paciente->distrit_residenciaactual_id='' : $paciente->distrit_residenciaactual_id=$request->get('distrito_actual');
        $request->get('direccion_nacimiento')=='' ? $paciente->direccion_nacimiento='' : $paciente->direccion_nacimiento=$request->get('direccion_nacimiento');   
        $request->get('departamento_nacimiento')=='' ? $paciente->departament_nacimiento_id='' : $paciente->departament_nacimiento_id=$request->get('departamento_nacimiento');
        $request->get('provincia_nacimiento')=='' ? $paciente->province_nacimiento_id='' : $paciente->province_nacimiento_id=$request->get('provincia_nacimiento');
        $request->get('distrito_nacimiento')=='' ? $paciente->distrit_nacimiento_id='' : $paciente->distrit_nacimiento_id=$request->get('distrito_nacimiento');
        if($paciente->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
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
        $paciente=Pacient::find($id);
        $paciente->estado='0';
        if($paciente->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
             ]);
        }

    }
}
