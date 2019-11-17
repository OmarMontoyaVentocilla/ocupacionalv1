<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equip;



class EquipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
 
    public function tospeciality(){
        $equipo= Equip::find(5);
        $speciality=$equipo->speciality;
        return $speciality;
    }


    public function querySearchEquipo($valor_caja){
        
        $valor=Equip::join('specialties', 'equips.specialties_id', '=', 'specialties.id')
            ->select('equips.id as id_equipo','descripcion_equipo','modelo','marca','nro_serie','fecha_calibracion','specialties.id as id_esp','nombre_esp')
            ->where(function($query) use($valor_caja) {
                $query->where('descripcion_equipo','like','%'.$valor_caja.'%')
                  ->orWhere('modelo', 'like','%'.$valor_caja.'%')
                  ->orWhere('marca', 'like','%'.$valor_caja.'%')    
                  ->orWhere('nro_serie', 'like','%'.$valor_caja.'%')
                  ->orWhere('fecha_calibracion', 'like','%'.$valor_caja.'%');
            })->where(function($query){
               $query->where('equips.estado',1);
            });
        return $valor;
    }

    public function listar(Request $request){
                    
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $equipo=$this->querySearchEquipo($valor_caja)
                           ->orderBy('equips.id', 'DESC')
                          ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Equip::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchEquipo($valor_caja)
                                  ->count();

        $response = [
            'pagination' => [
                'total' => $equipo->total(),
                'current_page' => $equipo->currentPage(),
                'per_page' => $equipo->perPage(),
                'last_page' => $equipo->lastPage(),
                'from' => $equipo->firstItem(),
                'to' => $equipo->lastItem(),
            ],
            'equipo' => $equipo,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 

        return response()->json($response);
    }

    
    
     public function index()
    {
        return view('equipo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return "1";
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'descripcion_equipo'        => 'required|max:100'
        ];

        $messages = [
            'descripcion_equipo.required'    => 'El campo descripción es obligatorio',
            'descripcion_equipo.max'         => 'El campo descripción debe tener como maximo 100 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);
        
        $equipo= new Equip;
        $equipo->descripcion_equipo= request('descripcion_equipo');
        request('modelo')=='' ?    $equipo->modelo='' : $equipo->modelo=request('modelo');
        request('marca')=='' ?     $equipo->marca='' :  $equipo->marca=request('marca');
        request('nro_serie')=='' ? $equipo->nro_serie='' : $equipo->nro_serie=request('nro_serie');
        request('fecha_calibracion')=='' ?  $equipo->fecha_calibracion='' : $equipo->fecha_calibracion=request('fecha_calibracion');
        request('especialidad_list')=='' ?  $equipo->specialties_id='' : $equipo->specialties_id=request('especialidad_list');
        $equipo->estado='1';
          if($equipo->save()){
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
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

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
            'descripcion_equipo'        => 'required|max:100'
        ];

        $messages = [
            'descripcion_equipo.required'    => 'El campo descripción es obligatorio',
            'descripcion_equipo.max'         => 'El campo descripción debe tener como maximo 100 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);
        $equipo=Equip::find($id);
        $equipo->descripcion_equipo= request('descripcion_equipo');
        request('modelo')=='' ?    $equipo->modelo='' : $equipo->modelo=request('modelo');
        request('marca')=='' ?     $equipo->marca='' :  $equipo->marca=request('marca');
        request('nro_serie')=='' ? $equipo->nro_serie='' : $equipo->nro_serie=request('nro_serie');
        request('fecha_calibracion')=='' ?  $equipo->fecha_calibracion='' : $equipo->fecha_calibracion=request('fecha_calibracion');
        request('especialidad_list')=='' ?  $equipo->specialties_id='' : $equipo->specialties_id=request('especialidad_list');
        $equipo->estado='1';
          if($equipo->save()){
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
        $equipo=Equip::find($id); 
        $equipo->estado = 0;
        if ($equipo->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
