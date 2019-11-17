<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Protocol;
use App\Company;
use App\Perfil;
use App\Catalogue;
use App\DetailCatalogue;
use App\DetailExam;

class ProtocoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function listar(Request $request){
        $id_company = $request->get('id_empresa');
        $listaprotcolosss = Company::join('catalogues', 'companies.id', '=', 'catalogues.company_id')
                      ->join('detailcatalogues', 'catalogues.id', '=', 'detailcatalogues.catalogue_id')
                      ->join('detail_exams', 'detail_exams.id', '=', 'detailcatalogues.examens_id')
                      ->select("detail_exams.id as id","detail_exams.codigo as codigo_examen","detail_exams.descripcion as descripcion_examen")
                      ->where('companies.id',$id_company)->get();
        $contadorprotocolos = Company::join('catalogues', 'companies.id', '=', 'catalogues.company_id')
                      ->join('detailcatalogues', 'catalogues.id', '=', 'detailcatalogues.catalogue_id')
                      ->join('detail_exams', 'detail_exams.id', '=', 'detailcatalogues.examens_id')
                      ->select("detail_exams.id as id","detail_exams.codigo as codigo_examen","detail_exams.descripcion as descripcion_examen")
                      ->where('companies.id',$id_company)->count();
        
                      $response = [
                        'listaprotcolosss'=>$listaprotcolosss,
                        'contadorprotocolos'=>$contadorprotocolos,
                    ]; 
                    
                    return response()->json($response);              
                      

    }

    public function contarprotocols(Request $request){
        $id_company = $request->get('id_empresa');
        $dets = Company::join('catalogues', 'companies.id', '=', 'catalogues.company_id')
                      ->join('detailcatalogues', 'catalogues.id', '=', 'detailcatalogues.catalogue_id')
                      ->join('detail_exams', 'detail_exams.id', '=', 'detailcatalogues.examens_id')
                      ->select("detail_exams.id as id","detail_exams.codigo as codigo_examen","detail_exams.descripcion as descripcion_examen")
                      ->where('companies.id',$id_company)->count();
        return response()->json($dets); 
    }

   
    public function querySearchProtocolo($valor_caja){
        $valor=Protocol::join('companies', 'companies.id', '=', 'protocols.company_id')
        ->join('profiles', 'profiles.id', '=', 'protocols.perfil_id')
        ->select("companies.id as codigo_empresa","companies.razon_social","profiles.id as codigo_perfil",
        "profiles.descripcion_perfil",'protocols.id','protocols.subcontrata',
        'protocols.descripcion','protocols.estado_protocolo','protocols.vigencia_inicial','protocols.vigencia_final',
        'protocols.total_preocupacional','protocols.total_periodico','protocols.total_retiro',
        'protocols.total_visita','protocols.total_reubicacion','protocols.datos_preocupacional','protocols.datos_periodico',
        'protocols.datos_retiro','protocols.datos_visita','protocols.datos_reubicacion','protocols.codigo_protocolo',
        'protocols.factura_protocolo')  
        ->where(function($query) use($valor_caja) {
                $query->where('companies.razon_social','like','%'.$valor_caja.'%')
                      ->orWhere('profiles.descripcion_perfil', 'like','%'.$valor_caja.'%');
            })->where(function($query){
               $query->where('protocols.estado',1);
            });
        return $valor;
    }

    public function listarprotocols(Request $request){
                $paginacion = '';
		        $valor_combo = $request->get('valor_combo');
		        $valor_caja =  $request->get('valor_caja');
      
                $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
                $resultados=$this->querySearchProtocolo($valor_caja)
                                 ->orderBy('protocols.id', 'DESC')
                                 ->paginate($paginacion);
                
                //TOTAL DE REGISTROS
                $total_registros=Protocol::where('estado',1)->count();
                //TOTAL DE REGISTROS EN BUSQUEDA
                $total_reg_busqueda=$this->querySearchProtocolo($valor_caja)
                                         ->count();                 

                $company=Company::where('estado',1)->select("companies.id","companies.razon_social")->get();
                
                
                $response = [
                    'pagination' => [
                        'total' => $resultados->total(),
                        'current_page' => $resultados->currentPage(),
                        'per_page' => $resultados->perPage(),
                        'last_page' => $resultados->lastPage(),
                        'from' => $resultados->firstItem(),
                        'to' => $resultados->lastItem(),
                    ],
                    'protocolos' => $resultados,
                    'company'=>$company,
                    'total_registros'=>$total_registros,
                    'total_reg_busqueda'=>$total_reg_busqueda,
                ]; 
                
                return response()->json($response);
    }

    public function listarprofiles(Request $request){
        $id_empresa = $request->get('id_empresa');
        $perfil='';
        if($id_empresa==''){
            $perfil=Perfil::where('company_id',0)->get();
        }else if($id_empresa!=''){
            $perfil=Perfil::where('company_id',$id_empresa)->get();
        }
        
        return response()->json($perfil); 
        
    }

    public function index()
    {   
        $company=Company::join('catalogues', 'companies.id', '=', 'catalogues.company_id')
                        ->select("companies.id","companies.razon_social")
                        ->where('catalogues.estado',1)
                        ->get();
        return view('protocolo.index',compact('company'));
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
        $valor_empresa=$request->get('valor_empresa');
        $valor_subcontrata=$request->get('valor_subcontrata');
        if($valor_subcontrata==''){
            $valor_subcontrata='0';
        }else if($valor_subcontrata!=''){
            $valor_subcontrata=$valor_subcontrata;
        }
        $valor_perfil=$request->get('valor_perfil');
        $valor_estado=$request->get('valor_estado');
        $valor_descripcion=$request->get('valor_descripcion');
        $valor_inicio_vig=$request->get('valor_inicio_vig');
        $valor_final_vig=$request->get('valor_final_vig');
        $valor_facturar_tipo=$request->get('valor_facturar_tipo');
        $valor_preocupacional=$request->get('valor_preocupacional');
        $valor_ocupacional=$request->get('valor_ocupacional');
        $valor_retiro=$request->get('valor_retiro');
        $valor_visita=$request->get('valor_visita');
        $valor_levantamiento=$request->get('valor_levantamiento');
        $array_preocupacional=$request->get('array_preocupacional');
        $array_periodico=$request->get('array_periodico');
        $array_retiro=$request->get('array_retiro');
        $array_visita=$request->get('array_visita');
        $array_levantamiento=$request->get('array_levantamiento');


       $resultado=Protocol::where('company_id',$valor_empresa)
                          ->where('perfil_id',$valor_perfil)
                          ->where('subcontrata',$valor_subcontrata)
                          ->where('estado','1')
                          ->count();
    if($resultado==''){

  if($valor_preocupacional!='' && $valor_ocupacional!='' && $valor_retiro!='' && $valor_visita!='' && $valor_levantamiento!=''){
    
    $protocolo=new Protocol;
    $protocolo->company_id=$valor_empresa; 
    $valor_subcontrata=='' ? $protocolo->subcontrata='' : $protocolo->subcontrata=$valor_subcontrata;
    $valor_descripcion=='' ? $protocolo->descripcion='' : $protocolo->descripcion=$valor_descripcion;  
    $protocolo->perfil_id=$valor_perfil;
    $protocolo->estado_protocolo=$valor_estado;
    $protocolo->vigencia_inicial=$valor_inicio_vig;
    $protocolo->vigencia_final=$valor_final_vig; 
    $protocolo->total_preocupacional=$valor_preocupacional; 
    $protocolo->total_periodico=$valor_ocupacional; 
    $protocolo->total_retiro=$valor_retiro; 
    $protocolo->total_visita=$valor_visita; 
    $protocolo->total_reubicacion=$valor_levantamiento; 
    $protocolo->datos_preocupacional=$array_preocupacional; 
    $protocolo->datos_periodico=$array_periodico; 
    $protocolo->datos_retiro=$array_retiro; 
    $protocolo->datos_visita=$array_visita; 
    $protocolo->datos_reubicacion=$array_levantamiento; 
    $protocolo->codigo_protocolo="PQO";
    $protocolo->factura_protocolo=$valor_facturar_tipo;
    $protocolo->estado='1';
    if($protocolo->save()){
        $response = [
            'mensaje' => 'Se registro exitosamente'
           
        ]; 
        return response()->json($response);
    }   
            
  }else{
    $response = [
        'mensaje' => 'No hay valores que guardar'
       
    ]; 
    return response()->json($response);
  }


        }else if($resultado!=''){
            $response = [
                'mensaje' => 'No hay ningun error, ya se ha registrado anteriorimente'
               
            ]; 
            return response()->json($response);
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
        $protocolo= Protocol::find($id);
        $request->get('descripcion')=='' ? $protocolo->descripcion='' : $protocolo->descripcion=$request->get('descripcion');  
        $protocolo->vigencia_final =$request->get( 'vigencia_inicial');
        $protocolo->vigencia_final =$request->get('vigencia_final');
        $protocolo->estado_protocolo=$request->get('estado_protocolo');
        $protocolo->factura_protocolo  =$request->get('factura_protocolo');
        $protocolo->datos_preocupacional =$request->get('datos_preocupacional');
        $protocolo->datos_periodico =$request->get('datos_periodico');
        $protocolo->datos_retiro =$request->get('datos_retiro');
        $protocolo->datos_visita =$request->get('datos_visita');
        $protocolo->datos_reubicacion =$request->get('datos_reubicacion');
        $protocolo->total_preocupacional =$request->get('totalpreocu_up');
        $protocolo->total_periodico =$request->get('totalocu_up');
        $protocolo->total_retiro =$request->get('totalretiro_up');
        $protocolo->total_visita =$request->get('totalvisita_up');
        $protocolo->total_reubicacion =$request->get('totalreubicacion_up');
        if($protocolo->save()){
            $response = [
                'mensaje' => 'Se registro exitosamente'
               
            ]; 
            return response()->json($response);
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
        $protocolo=Protocol::find($id);
        if($protocolo->delete()){
            $response = [
                'mensaje' => 'Se registro exitosamente'
               
            ]; 
            return response()->json($response);
        }
    }
}
