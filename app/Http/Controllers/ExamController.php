<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

  

    public function querySearchExam($valor_caja){
        
        $valor= Exam::where(function($query) use($valor_caja) {
            $query->where('codigo','like','%'.$valor_caja.'%')
                  ->orWhere('descripcion', 'like','%'.$valor_caja.'%');
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
        $examens=$this->querySearchExam($valor_caja)
                           ->orderBy('exams.id', 'DESC')
                          ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Exam::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchExam($valor_caja)
                                  ->count();

        $response = [
            'pagination' => [
                'total' => $examens->total(),
                'current_page' => $examens->currentPage(),
                'per_page' => $examens->perPage(),
                'last_page' => $examens->lastPage(),
                'from' => $examens->firstItem(),
                'to' => $examens->lastItem(),
            ],
            'examens' => $examens,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 

        return response()->json($response); 
    }

    public function index()
    {
        return  view('examen.index');
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
            'descripcion'        => 'required|max:200',
            'codigo'             => 'required|max:50'
        ];

        $messages = [
            'descripcion.required'    => 'El campo descripción es obligatorio',
            'descripcion.max'         => 'El campo descripción debe tener como maximo 200 caracteres',
            'codigo.required'         => 'El campo descripción es obligatorio',
            'codigo.max'              => 'El campo descripción debe tener como maximo 50 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);
        
        $exam= new Exam;
        $exam->descripcion= request('descripcion');
        $exam->codigo     = request('codigo');
        $exam->estado='1';
          if($exam->save()){
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
            'descripcion'        => 'required|max:200',
            'codigo'             => 'required|max:50'
        ];

        $messages = [
            'descripcion.required'    => 'El campo descripción es obligatorio',
            'descripcion.max'         => 'El campo descripción debe tener como maximo 200 caracteres',
            'codigo.required'         => 'El campo descripción es obligatorio',
            'codigo.max'              => 'El campo descripción debe tener como maximo 50 caracteres'
        ];
        
        $this->validate($request,$rules,$messages);
        $examen=Exam::find($id);
        $examen->descripcion= request('descripcion');
        $examen->codigo     = request('codigo');
        $examen->estado='1';
          if($examen->save()){
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
        $examen=Exam::find($id); 
        $examen->estado = 0;
        if ($examen->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
