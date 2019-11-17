<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Atention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Triaje;
class TriajeController extends Controller
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
        $triaje=Triaje::join('users', 'triajes.iddoctor', '=', 'users.id')
                     ->select("triajes.id","triajes.idcomprobante","triajes.iddoctor","triajes.fecha","triajes.sistolica",
                     "triajes.diastolica","triajes.fcardiaca","triajes.fcrespiratoria","triajes.sto2","triajes.talla",
                     "triajes.peso","triajes.imc","triajes.pabodminal","triajes.pte","triajes.pti","triajes.temperatura",
                     "triajes.cintura","triajes.pcadera","triajes.icc","triajes.ptoraxico","triajes.atendido","triajes.revisado",
                     "triajes.auditado","users.name")
                     ->where('idpaciente',$idpaciente)->where('triajes.estado',1)->paginate($paginacion);
       
        //TOTAL DE REGISTROS
        $total_registros=Triaje::where('idpaciente',$idpaciente)->where('triajes.estado',1)->count();
        
        $response = [
            'pagination' => [
                'total' => $triaje->total(),
                'current_page' => $triaje->currentPage(),
                'per_page' => $triaje->perPage(),
                'last_page' => $triaje->lastPage(),
                'from' => $triaje->firstItem(),
                'to' => $triaje->lastItem(),
                ],
                'triaje' => $triaje,
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
        $valor_orden_triaje=$request->get('orden');
        $idpaciente=$request->get('idpaciente');  
       
          //poner el idpaciente
        $idpaciente=Atention::where('id',$valor_orden_triaje)->where('estado',"1")->select('id_paciente')->get();
        
        //atendido
        $atendido=Triaje::select('atendido')->where('idcomprobante',$valor_orden_triaje)->where('estado',"1")->get();

        if($valor_orden_triaje!=''){
            $existe_atencion=Atention::where('id',$valor_orden_triaje)->where('estado',1)->count();
            if($existe_atencion!=''){
                return  view('triaje.index',compact('valor_orden_triaje','idpaciente','atendido'));
            }else{
                return  view('triaje.error'); 
            }   
        }else{
            return  view('triaje.error');
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
        $date = Carbon::now('America/Lima');
        $date = $date->format('Y-m-d');
        $triaje=new Triaje;
        $triaje->idcomprobante=request('idcomprobante');
        $triaje->idpaciente=request('idpaciente');
        $triaje->iddoctor=Auth::user()->id;
        $triaje->fecha=$date;
        $triaje->estado=1;
        $triaje->atendido="on";
        $triaje->revisado="";
        $triaje->auditado="";
        request('sistolica')=='' ? $triaje->sistolica='' : $triaje->sistolica=request('sistolica');
        request('diastolica')=='' ? $triaje->diastolica='' : $triaje->diastolica=request('diastolica');
        request('freccardiaca')=='' ? $triaje->fcardiaca='' : $triaje->fcardiaca=request('freccardiaca');
        request('frecrespiratoria')=='' ? $triaje->fcrespiratoria='' : $triaje->fcrespiratoria=request('frecrespiratoria');
        request('stao2')=='' ? $triaje->sto2='' : $triaje->sto2=request('stao2');
        request('talla')=='' ? $triaje->talla='' : $triaje->talla=request('talla');
        request('peso')=='' ? $triaje->peso='' : $triaje->peso=request('peso');
        request('imc')=='' ? $triaje->imc='' : $triaje->imc=request('imc');
        request('pabdominal')=='' ? $triaje->pabodminal='' : $triaje->pabodminal=request('pabdominal');
        request('pte')=='' ? $triaje->pte='' : $triaje->pte=request('pte');
        request('pti')=='' ? $triaje->pti='' : $triaje->pti=request('pti');
        request('temperatura')=='' ? $triaje->temperatura='' : $triaje->temperatura=request('temperatura');
        request('cintura')=='' ? $triaje->cintura='' : $triaje->cintura=request('cintura');
        request('pcadera')=='' ? $triaje->pcadera='' : $triaje->pcadera=request('pcadera');
        request('icc')=='' ? $triaje->icc='' : $triaje->icc=request('icc');
        request('ptoraxico')=='' ? $triaje->ptoraxico='' : $triaje->ptoraxico=request('ptoraxico');
        
        if($triaje->save()){
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
        $orden=$id;
        return redirect()->route('triaje.index',compact('orden'));
        
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
        $triaje= Triaje::find($id);
        request('sistolica')=='' ? $triaje->sistolica='' : $triaje->sistolica=request('sistolica');
        request('diastolica')=='' ? $triaje->diastolica='' : $triaje->diastolica=request('diastolica');
        request('fcardiaca')=='' ? $triaje->fcardiaca='' : $triaje->fcardiaca=request('fcardiaca');
        request('frespiratoria')=='' ? $triaje->fcrespiratoria='' : $triaje->fcrespiratoria=request('frespiratoria');
        request('sato2')=='' ? $triaje->sto2='' : $triaje->sto2=request('sato2');
        request('talla')=='' ? $triaje->talla='' : $triaje->talla=request('talla');
        request('peso')=='' ? $triaje->peso='' : $triaje->peso=request('peso');
        request('imc')=='' ? $triaje->imc='' : $triaje->imc=request('imc');
        request('pabdominal')=='' ? $triaje->pabodminal='' : $triaje->pabodminal=request('pabdominal');
        request('pte')=='' ? $triaje->pte='' : $triaje->pte=request('pte');
        request('pti')=='' ? $triaje->pti='' : $triaje->pti=request('pti');
        request('temperatura')=='' ? $triaje->temperatura='' : $triaje->temperatura=request('temperatura');
        request('cintura')=='' ? $triaje->cintura='' : $triaje->cintura=request('cintura');
        request('pcadera')=='' ? $triaje->pcadera='' : $triaje->pcadera=request('pcadera');
        request('icc')=='' ? $triaje->icc='' : $triaje->icc=request('icc');
        request('ptoraxico')=='' ? $triaje->ptoraxico='' : $triaje->ptoraxico=request('ptoraxico');

        if($triaje->save()){
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
        $triaje= Triaje::find($id);
        $triaje->estado="0";
        if($triaje->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
             ]);
          }
    }
}
