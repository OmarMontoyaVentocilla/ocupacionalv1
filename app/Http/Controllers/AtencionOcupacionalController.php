<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Pacient;
use App\TipoExam;
use App\Exam;
use App\DetailExam;
use App\Area;
use App\Obra;
use App\Perfil;
use App\Atention;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Triaje;

class AtencionOcupacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }


    public function atencion(Request $request){
       $idorden=$request->get('id');
  
       //Triaje;
      $triaje=Triaje::where('idcomprobante',$idorden)->where('estado',1)->select("atendido")->get();
      $response = [
                
                'triaje' => $triaje
                
            ]; 
            
       return response()->json($response);
     
    }

    public function querySearchOrden($valor_nombre,$valorcodigo,$idempresa,$idsubcontrata){
        $valor=Atention::join('pacients', 'pacients.id', '=', 'ordenatentions.id_paciente')
                        ->join('companies', 'companies.id', '=', 'ordenatentions.empresa_id')
                        ->join('areas', 'companies.id', '=', 'areas.company_id')
                        ->join('obras', 'companies.id', '=', 'obras.company_id')
                        ->join('profiles', 'companies.id', '=', 'profiles.company_id') 
                        ->join('tipo_exam', 'tipo_exam.id', '=', 'ordenatentions.tipoexam_id') 
        ->select("ordenatentions.id","ordenatentions.id_subcontrata",'ordenatentions.empresa_id',
        "ordenatentions.nro_orden","ordenatentions.hora_inicio",
        "ordenatentions.subtotal",'ordenatentions.igv','ordenatentions.total',"ordenatentions.fecha",
        'ordenatentions.examenes_vendidos','ordenatentions.examenes_vendidos_precios','ordenatentions.idformato',
        'pacients.nro_documento','pacients.tipo_documento','pacients.nombres','pacients.ap_materno',
        'pacients.ap_paterno','pacients.sexo','pacients.fecha_nacimiento','pacients.edad','pacients.telefono','pacients.estado_civil',
        DB::raw("(CONCAT(pacients.ap_paterno,' ',pacients.ap_materno,' ',pacients.nombres)) as nombres_total"),
        'companies.ruc','companies.razon_social','companies.nombre_comercial',
        'companies.actividad_economica','companies.direccion','tipo_exam.descripcion_ex','areas.descripcion_areas',
        'obras.descripcion_obra','profiles.descripcion_perfil')
        ->when($valor_nombre, function ($query) use ($valor_nombre) {
            return $query->where('pacients.ap_paterno','like','%'.$valor_nombre.'%');
         })
         ->when($valorcodigo, function ($query) use ($valorcodigo) {
            return $query->where('ordenatentions.nro_orden', 'like','%'.$valorcodigo.'%');
         })
         ->when($idempresa, function ($query) use ($idempresa) {
            return $query->where('ordenatentions.empresa_id',$idempresa);
         })
         ->when($idsubcontrata, function ($query) use ($idsubcontrata) {
            return $query->where('ordenatentions.id_subcontrata',$idsubcontrata);
         });
        return $valor;
    }
    
    public function consulta(Request $request){
        $array_ex = $request->get('array_ex');
        $data = [];
        foreach  ($array_ex as $key => $value){
            $valor=DetailExam::select("exams_id")->where('id',$value)->get();
            array_push($data,$valor);
        }
        return response()->json($data);
    }

    public function listar(Request $request){
    
        $paginacion          =  '';
		$valor_combo         =  $request->get('valor_combo');
        $valor_nombre        =  $request->get('valor_nombre');
        $valorcodigo         =  $request->get('valor_codigo');
        $idempresa           =  $request->get('valor_idempresa');
        $idsubcontrata       =  $request->get('valor_idsubcontrata');
        $fecha_inicio        =  $request->get('valor_fecha');
        $valor_fechafinal    =  $request->get('valor_fechafinal');

            $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
            $atenciones=$this->querySearchOrden($valor_nombre,$valorcodigo,$idempresa,$idsubcontrata)
                             ->whereBetween('ordenatentions.fecha', [$fecha_inicio, $valor_fechafinal])
                             ->where('ordenatentions.tipo_orden_atencion',1)
                             ->where('ordenatentions.estado',1)
                             ->orderBy('ordenatentions.fecha', 'desc')
                             ->groupBy('ordenatentions.id')
                             ->paginate($paginacion);
            //TOTAL DE REGISTROS
            $total_registros=$this->querySearchOrden($valor_nombre,$valorcodigo,$idempresa,$idsubcontrata)
                                         ->whereBetween('ordenatentions.fecha', [$fecha_inicio, $valor_fechafinal])
                                        ->where('ordenatentions.tipo_orden_atencion',1)
                                        ->where('ordenatentions.estado',1)     
                                        ->groupBy('ordenatentions.id')
                                        ->count();
            //TOTAL DE REGISTROS EN BUSQUEDA
            $total_reg_busqueda=$this->querySearchOrden($valor_nombre,$valorcodigo,$idempresa,$idsubcontrata)
                                        ->where('ordenatentions.tipo_orden_atencion',1)
                                        ->where('ordenatentions.estado',1)
                                        ->groupBy('ordenatentions.id')
                                        ->count();  

        $response = [
                'pagination' => [
                    'total' => $atenciones->total(),
                    'current_page' => $atenciones->currentPage(),
                    'per_page' => $atenciones->perPage(),
                    'last_page' => $atenciones->lastPage(),
                    'from' => $atenciones->firstItem(),
                    'to' => $atenciones->lastItem(),
                ],
                'atenciones' => $atenciones,
                'total_registros'=>$total_registros,
                'total_reg_busqueda'=>$total_reg_busqueda,
            ]; 
            
       return response()->json($response);
    }

    public function index()
    {   
    
        return view('atenocup.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
