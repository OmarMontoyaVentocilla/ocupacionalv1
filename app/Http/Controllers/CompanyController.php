<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Departament;
use App\Province;
use App\Distrit;
use App\Company;

class CompanyController extends Controller
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
        $id_departamento=$request->get('id_departamento');
        $provincia=Province::select("id","nombre_prov")->where('departaments_id',$id_departamento)->get();
        $response = [
            'provincia'=>$provincia
        ]; 
        return response()->json($response);
    }

    public function listardis(Request $request){
        $id_provincia=$request->get('id_provincia');
        $distrito=Distrit::select("id","nombre_distrito")->where('provinces_id',$id_provincia)->get();
        $response = [
            'distrito'=>$distrito
        ]; 
        return response()->json($response);     
    }

    public function querySearchEmpresa($valor_caja){

        $valor= Company::where(function($query) use($valor_caja) {
            $query->where('ruc','like','%'.$valor_caja.'%')
                  ->orWhere('razon_social', 'like','%'.$valor_caja.'%');
        })->where(function($query){
            $query->where('estado',1);
        });
        return $valor;
    }

    public function listardata(Request $request){
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $companny=$this->querySearchEmpresa($valor_caja)
                          ->orderBy('id', 'DESC')
                          ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Company::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchEmpresa($valor_caja)
                                  ->count();
         
        $response = [
             'pagination' => [
                    'total' => $companny->total(),
                    'current_page' => $companny->currentPage(),
                    'per_page' => $companny->perPage(),
                    'last_page' => $companny->lastPage(),
                    'from' => $companny->firstItem(),
                     'to' => $companny->lastItem(),
            ],
                'company' => $companny,
                'total_registros'=>$total_registros,
                'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 
        return response()->json($response);
    }

     public function index()
    {
        $rol= Role::find(14);
        $rol_nombre=$rol->name;
        $users = User::role($rol_nombre)->select("id","name")->get();
        //DEPARTAMENTOS
        $departamento=Departament::select("id","nombre")->get();
        //  //PROVINCIA
        // $provincia=Province::select("id","name")->where('departaments_id',$departamento->id);   

        return  view('empresa.index',compact('users','departamento'));
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
            'ruc'              =>  'required|max:11',
            'razon_social'     =>  'required|max:255',
            'departamento_mod' =>  'required',
            'provincia'        =>  'required',
            'distrit'          =>  'required',
            'telefono1'        =>  'required',
            'contacto1'        =>  'required',
            'email1'           =>  'required',
            'periodo_corte_facturacion'=>'required',
            'limite_orden_compra'=>'required',
            'dia_creditos_sel'=>'required'
        ];

        $messages = [
            'ruc.required'               => 'El campo es obligatorio',
            'ruc.max'                    => 'El campo debe tener como maximo 11 caracteres',
            'razon_social.required'      => 'El campo es obligatorio',
            'departamento_mod.required'  => 'El campo es obligatorio',
            'provincia.required'         => 'El campo es obligatorio',
            'distrit.required'           => 'El campo es obligatorio',
            'telefono1.required'         => 'El campo es obligatorio',
            'contacto1.required'         => 'El campo es obligatorio',
            'email1.required'            => 'El campo es obligatorio',
            'periodo_corte_facturacion.required' =>'El campo es obligatorio',
            'limite_orden_compra.required'   =>'El campo es obligatorio',
            'dia_creditos_sel.required'    =>'El campo es obligatorio'
            ];
        
        $this->validate($request,$rules,$messages);
        $company= new Company;
        $company->ruc = $request->get('ruc');
        $company->razon_social= $request->get('razon_social');
        request('nombre_comercial')=='' ? $company->nombre_comercial='' : $company->nombre_comercial=request('nombre_comercial');
        request('actividad_economica')=='' ? $company->actividad_economica='' : $company->actividad_economica=request('actividad_economica');
        request('direccion')=='' ? $company->direccion='' : $company->direccion=request('direccion');
        $company->departament_id= $request->get('departamento_mod');
        $company->province_id= $request->get('provincia');
        $company->distrit_id= $request->get('distrit');
        request('rubro_mineria')=='' ? $company->rubro_mineria='' : $company->rubro_mineria=request('rubro_mineria');
        request('rubro_contruccion')=='' ? $company->rubro_contruccion='' : $company->rubro_contruccion=request('rubro_contruccion');
        request('rubro_industria')=='' ? $company->rubro_industria='' : $company->rubro_industria=request('rubro_industria');
        request('rubro_comercio')=='' ? $company->rubro_comercio='' : $company->rubro_comercio=request('rubro_comercio');
        request('rubro_banca')=='' ? $company->rubro_banca='' : $company->rubro_banca=request('rubro_banca');
        request('rubro_logistico')=='' ? $company->rubro_logistico='' : $company->rubro_logistico=request('rubro_logistico');
        request('rubro_callcenter')=='' ? $company->rubro_callcenter='' : $company->rubro_callcenter=request('rubro_callcenter'); 
        request('rubro_otro')=='' ? $company->rubro_otro='' : $company->rubro_otro=request('rubro_otro');
        $company->telefono_nro1= $request->get('telefono1');
        request('telefono2')=='' ? $company->telefono_nro2='' : $company->telefono_nro2=request('telefono2');
        $company->contacto_nr1= $request->get('contacto1');
        request('contacto2')=='' ? $company->contacto_nro2='' : $company->contacto_nro2=request('contacto2');
        $company->email_nr1= $request->get('email1');
        request('email2')=='' ? $company->email_nr2='' : $company->email_nr2=request('email2');
        $company->corte_facturacion= $request->get('periodo_corte_facturacion');
        $company->envio_orden_compra= $request->get('limite_orden_compra');
        $company->dias_credito= $request->get('dia_creditos_sel');
        request('inicio_facturacion')=='' ? $company->inicio_facturacion='' : $company->inicio_facturacion=request('inicio_facturacion');
        request('observacion')=='' ? $company->observacion='' : $company->observacion=request('observacion');
        request('inscripcion')=='' ? $company->inscripcion='' : $company->inscripcion=request('inscripcion');
        request('habilitar')=='' ? $company->habilitar_extranet='' : $company->habilitar_extranet=request('habilitar');
        request('pagina_principal')=='' ? $company->pagina='' : $company->pagina=request('pagina_principal');
        request('ejecutivo_ventas')=='' ? $company->ejecutivo_ventas='' : $company->ejecutivo_ventas=request('ejecutivo_ventas');
        $company->estado= "1";
        if($company->save()){
            return response()->json([
        		"success" => true,
		 		"message" => "Se registro exitosamente",
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
        $empresa=Company::find($id); 
        $empresa->estado = 0;
        if ($empresa->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
