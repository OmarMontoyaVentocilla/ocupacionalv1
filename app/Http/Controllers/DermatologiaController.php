<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Atention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Dermatologia;
use App\Doctor;
use App\User;

class DermatologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function datos(Request $request){
        $paginacion = '';
		$valor_combo    = $request->get('valor_combo');
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $idpaciente=$request->get('idpaciente');
        $dermatologia=Dermatologia::join('users', 'dermatologies.iddoctor', '=', 'users.id')
                     ->select("users.name",'dermatologies.id', 'dermatologies.idcomprobante', 
                           'dermatologies.idpaciente','dermatologies.iddoctor','dermatologies.fecha',
                            'dermatologies.opcion1','dermatologies.respuesta_opcion1',
                            'dermatologies.opcion2', 'dermatologies.respuesta1_opcion2', 'dermatologies.respuesta2_opcion2',
                            'dermatologies.opcion3','dermatologies.opcion4','dermatologies.opcion5',
                            "dermatologies.respuesta_opcion5","dermatologies.opcion6","dermatologies.respuesta_opcion6",
                            "dermatologies.opcion7","dermatologies.respuesta_opcion7","dermatologies.opcion8",
                            "dermatologies.opcion9","dermatologies.respuesta_opcion9","dermatologies.opcion10",
                            "dermatologies.opcion11","dermatologies.opcion12","dermatologies.respuesta_opcion12",
                            "dermatologies.opcion13","dermatologies.opcion14","dermatologies.opcion15",
                            "dermatologies.respuesta_opcion16","dermatologies.respuesta_opcion17","dermatologies.opcion18",
                            "dermatologies.opcion19","dermatologies.opcion20","dermatologies.conclusiones","dermatologies.cabeza",
                            "dermatologies.tronco","dermatologies.extremidades","dermatologies.wood","dermatologies.nokolsky",
                            "dermatologies.descripcion","dermatologies.atendido","dermatologies.revisado","dermatologies.auditado",
                            "dermatologies.estado")
                     ->where('idpaciente',$idpaciente)->where('dermatologies.estado',1)->paginate($paginacion);
       
        //TOTAL DE REGISTROS
        $total_registros=Dermatologia::where('idpaciente',$idpaciente)->where('dermatologies.estado',1)->count();
        
        $response = [
            'pagination' => [
                'total' => $dermatologia->total(),
                'current_page' => $dermatologia->currentPage(),
                'per_page' => $dermatologia->perPage(),
                'last_page' => $dermatologia->lastPage(),
                'from' => $dermatologia->firstItem(),
                'to' => $dermatologia->lastItem(),
                ],
                'dermatologia' => $dermatologia,
                'total_registros'=>$total_registros  
            ]; 
                        
        return response()->json($response);
    }

    
    public function listar(Request $request){
            $valor_orden=$request->get('valor_orden');
        $valor=Atention::join('pacients', 'pacients.id', '=', 'ordenatentions.id_paciente')
        ->join('companies', 'companies.id', '=', 'ordenatentions.empresa_id')
        ->join('areas', 'companies.id', '=', 'areas.company_id')
        ->join('obras', 'companies.id', '=', 'obras.company_id')
        ->join('profiles', 'companies.id', '=', 'profiles.company_id') 
        ->join('users', 'companies.ejecutivo_ventas', '=', 'users.id') 
        ->join('tipo_exam', 'tipo_exam.id', '=', 'ordenatentions.tipoexam_id') 
            ->select("ordenatentions.id","ordenatentions.id_subcontrata",'ordenatentions.empresa_id',
            "ordenatentions.nro_orden","ordenatentions.hora_inicio","users.name",
            "ordenatentions.subtotal",'ordenatentions.igv','ordenatentions.total',"ordenatentions.fecha",
            'ordenatentions.examenes_vendidos','ordenatentions.examenes_vendidos_precios','ordenatentions.idformato',
            'pacients.nro_documento','pacients.tipo_documento','pacients.nombres','pacients.ap_materno',
            'pacients.ap_paterno','pacients.sexo','pacients.fecha_nacimiento','pacients.edad','pacients.telefono',
            'pacients.estado_civil','pacients.id as idpaciente',
            DB::raw("(CONCAT(pacients.ap_paterno,' ',pacients.ap_materno,' ',pacients.nombres)) as nombres_total"),
            'companies.ruc','companies.razon_social','companies.nombre_comercial',
            'companies.actividad_economica','companies.direccion','tipo_exam.descripcion_ex','areas.descripcion_areas',
            'obras.descripcion_obra','profiles.descripcion_perfil')
            ->where('ordenatentions.tipo_orden_atencion',1)
            ->where('ordenatentions.estado',1)
            ->where('ordenatentions.id',$valor_orden)
            ->groupBy('ordenatentions.id')->get();
            return response()->json($valor);
    }


    public function index(Request $request)
    {
        $valor_orden_derma=$request->get('orden');
        $idpaciente=$request->get('idpaciente');  
       
        //poner el idpaciente
        $idpaciente=Atention::where('id',$valor_orden_derma)->where('estado',"1")->select('id_paciente')->get();
        
        //atendido
        $atendido=Dermatologia::select('atendido')->where('idcomprobante',$valor_orden_derma)->where('estado',"1")->get();

        //doctores
        $dermatologia_doctores=Doctor::join('users', 'doctors.idsuariod', '=', 'users.id')
                            ->select("users.name",'users.id')
                            ->where('doctors.estado',1)
                            ->get();

        if($valor_orden_derma!=''){
            $existe_atencion=Atention::where('id',$valor_orden_derma)->where('estado',1)->count();
            if($existe_atencion!=''){
                return  view('dermatologia.index',compact('valor_orden_derma','idpaciente','atendido','dermatologia_doctores'));
            }else{
                return  view('dermatologia.error'); 
            }   
        }else{
            return  view('dermatologia.error');
        }   
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
        $orden=$id;
        return redirect()->route('dermatologia.index',compact('orden'));
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
        $dermat= Dermatologia::find($id);
        $dermat->estado="0";
        if($dermat->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
             ]);
          }
    }
}
