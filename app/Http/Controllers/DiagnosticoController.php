<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Diagnostic;
class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct(){
        $this->middleware('auth');
    }
   
    public function querySearchDiagnostic($valor_caja){

        $valor= Diagnostic::where(function($query) use($valor_caja) {
            $query->where('descripcion','like','%'.$valor_caja.'%')
                  ->orWhere('recomendaciones', 'like','%'.$valor_caja.'%')
                  ->orWhere('cie10', 'like','%'.$valor_caja.'%');
        })->where(function($query){
            $query->where('estado',1);
        });
        return $valor;
    }

    public function listar(Request $request){
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $diagnostico=$this->querySearchDiagnostic($valor_caja)
                          ->orderBy('id', 'DESC')
                          ->paginate($paginacion);


        //TOTAL DE REGISTROS
        $total_registros=Diagnostic::where('estado',1)->count();
        //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=$this->querySearchDiagnostic($valor_caja)
                                ->count();

        $response = [
            'pagination' => [
                'total' => $diagnostico->total(),
                'current_page' => $diagnostico->currentPage(),
                'per_page' => $diagnostico->perPage(),
                'last_page' => $diagnostico->lastPage(),
                'from' => $diagnostico->firstItem(),
                'to' => $diagnostico->lastItem(),
            ],
            'diagnostico' => $diagnostico,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 


        return response()->json($response);
    }
    
    
     public function index()
    { 
        return view('diagnostico.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'cie10'        => 'required|max:10',
            'descripcion'  =>  'required|max:255'
        ];

        $messages = [
            'cie10.required'          => 'El campo CIE 10 es obligatorio',
            'descripcion.required'    => 'El campo descripcion es obligatorio',
            'cie10.max'               => 'El campo CIE 1O debe tener como maximo 10 caracteres',
            'descripcion.max'         => 'El campo descripcion debe tener como maximo 255 caracteres',
        ];
        
        $this->validate($request,$rules,$messages);
        
        $diagnostico= new Diagnostic;
        $diagnostico->descripcion=request('descripcion');
        $diagnostico->cie10=request('cie10');
        request('recomendaciones')=='' ? $diagnostico->recomendaciones='' : $diagnostico->recomendaciones=request('recomendaciones');
        $diagnostico->estado='1';
          if($diagnostico->save()){
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
            'cie10'        => 'required|max:10',
            'descripcion'  =>  'required|max:255'
        ];

        $messages = [
            'cie10.required'          => 'El campo CIE 10 es obligatorio',
            'descripcion.required'    => 'El campo descripcion es obligatorio',
            'cie10.max'               => 'El campo CIE 1O debe tener como maximo 10 caracteres',
            'descripcion.max'         => 'El campo descripcion debe tener como maximo 255 caracteres',
        ];
        $this->validate($request,$rules,$messages);


        $diagnostic=Diagnostic::find($id);
        $diagnostic->descripcion    = $request->get('descripcion');
        $diagnostic->cie10          = $request->get('cie10');
request('recomendaciones')=='' ? $diagnostic->recomendaciones='' : $diagnostic->recomendaciones=request('recomendaciones');
        $diagnostic->estado         = '1';

		if ($diagnostic->save()) {
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
        $diagnostico=Diagnostic::find($id); 
        $diagnostico->estado = 0;
        if ($diagnostico->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
