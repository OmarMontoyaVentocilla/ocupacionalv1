<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atention;
use App\Pacient;
use App\Protocol;
use App\Company;
use App\TipoExam;
use App\Area;
use App\Perfil;
use App\Obra;
use Illuminate\Support\Facades\DB;

class AtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct() {
		$this->middleware('auth');
    }
    

    public function listardata(Request $request){
        $idempresa    = $request->get('id_empresa');
        $idperfil     = $request->get('id_perfil');
        $idtipoexamen     = $request->get('id_tipoexamen');
        $data='';
      
        if($idtipoexamen=='1'){  //PREOCUPACIONAL
            $data=Protocol::where('company_id',$idempresa)
                       ->where('perfil_id',$idperfil)
                       ->where('estado',1)
                       ->select('total_preocupacional','datos_preocupacional')
                       ->get();
        }else if($idtipoexamen=='2'){  //PERIODICO
            $data=Protocol::where('company_id',$idempresa)
                       ->where('perfil_id',$idperfil)
                       ->where('estado',1)
                       ->select('total_periodico','datos_periodico')
                       ->get();
        }else if($idtipoexamen=='3'){  //RETIRO
            $data=Protocol::where('company_id',$idempresa)
                      ->where('perfil_id',$idperfil)
                      ->where('estado',1)
                      ->select('total_retiro','datos_retiro')
                      ->get();
        }else if($idtipoexamen=='4'){  //VISITA
            $data=Protocol::where('company_id',$idempresa)
                      ->where('perfil_id',$idperfil)
                      ->where('estado',1)
                      ->select('total_visita','datos_visita')
                      ->get();
        }else if($idtipoexamen=='5'){ //REUBICACION
            $data=Protocol::where('company_id',$idempresa)
                      ->where('perfil_id',$idperfil)
                      ->where('estado',1)
                      ->select('total_reubicacion','datos_reubicacion')
                      ->get();
        }else{
            $data=''; 
        }
        

        return response()->json($data);



    }
 
    public function listar(Request $request){
        $idempresa    = $request->get('idempresa');

    //obras
    $obra=Obra::where('company_id',$idempresa)->where('estado',1)->get();
    //perfil
    $perfil=Perfil::where('company_id',$idempresa)->where('estado',1)->get();
    //area
    $area=Area::where('company_id',$idempresa)->where('estado',1)->get();

    //formato

    $formato=Company::select('pagina')->where('id',$idempresa)->where('estado',1)->get();

    $response = [
        'obra' => $obra,
        'perfil'=>$perfil,
        'area'=>$area,
        'formato'=>$formato
    ]; 
    return response()->json($response);


    }

    public function atencion(){
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
'pacients.ap_paterno','pacients.sexo','pacients.fecha_nacimiento','pacients.edad','pacients.telefono','pacients.estado_civil',
DB::raw("(CONCAT(pacients.ap_paterno,' ',pacients.ap_materno,' ',pacients.nombres)) as nombres_total"),
'companies.ruc','companies.razon_social','companies.nombre_comercial',
'companies.actividad_economica','companies.direccion','tipo_exam.descripcion_ex','areas.descripcion_areas',
'obras.descripcion_obra','profiles.descripcion_perfil')
->where('ordenatentions.tipo_orden_atencion',1)
->where('ordenatentions.estado',1)
->groupBy('ordenatentions.id')->get();
return response()->json($valor);
    }

    public function index()
    {   
        $company=Company::join('catalogues', 'companies.id', '=', 'catalogues.company_id')
                        ->select("companies.id","companies.razon_social","companies.pagina")
                        ->where('catalogues.estado',1)
                        ->get(); 

        $paciente=Pacient::select("id","hc","tipo_documento","nro_documento","ap_paterno","ap_materno","nombres",
        "sexo","fecha_nacimiento","edad","telefono","estado_civil","grado_instruccion","pais_residenciaactual_id",
        "departament_residenciaactual_id","province_residenciaactual_id","distrit_residenciaactual_id",
        "direccion_residenciaactual","pais_nacimiento_id","departament_nacimiento_id","province_nacimiento_id",
        "distrit_nacimiento_id","direccion_nacimiento", 
        DB::raw("(CONCAT(ap_paterno,' ',ap_materno,' ',nombres)) as nombres_total")
        )->where('estado',1)->get();    
        
        $tipo_examen=TipoExam::where('estado',1)->get();
        return view('atencion.index',compact('company','paciente','tipo_examen'));
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
        $atencion=new Atention;
        $nro_orden = DB::table('ordenatentions')->max('id');
        $nro_orden_valor=str_pad($nro_orden+1,10,"0",STR_PAD_LEFT);
        $atencion->servicio=$request->get('servicio');
        $atencion->fecha=$request->get('fecha');
        $atencion->hora_inicio=$request->get('hora_inicio');
        $atencion->empresa_id=$request->get('empresa_id');
        $atencion->id_paciente=$request->get('id_paciente');
        $request->get('area_id')=='' ? $atencion->area_id=null : $atencion->area_id=$request->get('area_id');
        $request->get('obra_id')=='' ? $atencion->obra_id=null : $atencion->obra_id=$request->get('obra_id');
        $atencion->profile_id=$request->get('profile_id');
        $atencion->tipoexam_id=$request->get('tipoexam_id');
        $request->get('id_subcontrata')=='' ? $atencion->id_subcontrata=null : $atencion->id_subcontrata=$request->get('id_subcontrata');
        $atencion->idformato=$request->get('idformato');
        $atencion->nro_orden=$nro_orden_valor;
        $atencion->subtotal=$request->get('subtotal');
        $atencion->igv=$request->get('igv');
        $atencion->total=$request->get('total');
        $atencion->examenes_vendidos=$request->get('examenes_vendidos');
        $atencion->examenes_vendidos_precios=$request->get('examenes_vendidos_precios');
        $atencion->tipo_orden_atencion=$request->get('idorden');
        $atencion->estado="1";
        if($atencion->save()){
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
        $ordenat=Atention::find($id); 
        $ordenat->estado = 0;
        if ($ordenat->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
