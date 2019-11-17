<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailExam;
use App\Exam;
    
class DetailExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function querySearchDetailExam($valor_caja){
        
        $valor= DetailExam::where(function($query) use($valor_caja) {
            $query->where('codigo','like','%'.$valor_caja.'%')
                  ->orWhere('descripcion', 'like','%'.$valor_caja.'%');
        })->where(function($query){
            $query->where('estado',1);
        });
        return $valor;
    }
    
    public function listardetalle(Request $request){
       
        //MOSTRAR LOS ID_EXAMENES DE DETALLE EXAMENES
        $showids=DetailExam::select("exams_id")->where('estado',1)->groupBy('exams_id')->get();
        //MOSTRAR LOS EXAMENES que no tienen niunguna relacion de codigo
        $showexams=Exam::select("id as id_examen","codigo as codigo_examen","descripcion as descripcion_examen")->where('estado',1)->whereNotIn('id',$showids)->get();

        $dets = Exam::join('detail_exams', 'exams.id', '=', 'detail_exams.exams_id')
            ->select("exams.id as id_examen","exams.codigo as codigo_examen","exams.descripcion as descripcion_examen",
                    DB::raw("(GROUP_CONCAT(detail_exams.id SEPARATOR '/')) as id_subexamen"),
                    DB::raw("(GROUP_CONCAT(detail_exams.codigo SEPARATOR '/')) as codigo_subexamen"),
                    DB::raw("(GROUP_CONCAT(detail_exams.descripcion SEPARATOR '/')) as descripcion_subbexamen")
                    )
            ->where('exams.estado','1')
            ->where('detail_exams.estado','1')
            ->groupBy('exams.codigo')
            ->get(); 
          
            $response = [
                'lista_examens_relacionados'=>$dets,
                'lista_examens_sinrelacion'=>$showexams
            ]; 

        return response()->json($response);
    }
    

    public function listar(Request $request){
        $paginacion = '';
		$valor_combo    = $request->get('valor_combo2');
        $valor_caja    =  $request->get('valor_caja2');
        $codigo_examen =  $request->get('codigo_examen');      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $detailexamens=$this->querySearchDetailExam($valor_caja)
                            ->where('exams_id',$codigo_examen) 
                            ->orderBy('detail_exams.id', 'DESC')
                            ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=DetailExam::where('estado',1)->where('exams_id',$codigo_examen)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchDetailExam($valor_caja)->where('exams_id',$codigo_examen) 
                                  ->count();

        $response = [
            'pagination' => [
                'total' => $detailexamens->total(),
                'current_page' => $detailexamens->currentPage(),
                'per_page' => $detailexamens->perPage(),
                'last_page' => $detailexamens->lastPage(),
                'from' => $detailexamens->firstItem(),
                'to' => $detailexamens->lastItem(),
            ],
            'detailexamens' => $detailexamens,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 

        return response()->json($response); 
    }

    public function index()
    {
        //
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
        
        $detailexam= new DetailExam;
        $detailexam->descripcion= request('descripcion');
        $detailexam->codigo     = request('codigo');
        $detailexam->exams_id   = request('exams_id');
        $detailexam->estado='1';
          if($detailexam->save()){
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
        $detailexamen=DetailExam::find($id);
        $detailexamen->descripcion= request('descripcion');
        $detailexamen->codigo     = request('codigo');
        $detailexamen->exams_id   = request('exams_id');
        $detailexamen->estado='1';
          if($detailexamen->save()){
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
        $detexamen=DetailExam::find($id); 
        $detexamen->estado = 0;
        if ($detexamen->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
