<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Catalogue;
use App\DetailCatalogue;

class CatalogoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function catalogosdet(Request $request){
        $idcatalogox = $request->get('idcatalogox');
        $detalle=DetailCatalogue::select('examens_id','inscrito')
                 ->where('estado',1)
                 ->where('catalogue_id',$idcatalogox)->get();
        return response()->json($detalle);
    }

    public function querySearchCatalogo($valor_caja){
        
        $valor=Catalogue::join('companies', 'catalogues.company_id', '=', 'companies.id')
              ->select('catalogues.id as id','companies.razon_social')
              ->where(function($query) use($valor_caja) {
                $query->where('companies.razon_social','like','%'.$valor_caja.'%');
            })->where(function($query){
               $query->where('catalogues.estado',1);
            });
        return $valor;
    }

    public function listar(Request $request)
    {     
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;

        $catalogos=$this->querySearchCatalogo($valor_caja)
                           ->orderBy('catalogues.id', 'DESC')
                           ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Catalogue::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchCatalogo($valor_caja)
                                  ->count();

         $response = [
             'pagination' => [
                            'total' => $catalogos->total(),
                            'current_page' => $catalogos->currentPage(),
                            'per_page' => $catalogos->perPage(),
                            'last_page' => $catalogos->lastPage(),
                            'from' => $catalogos->firstItem(),
                            'to' => $catalogos->lastItem(),
              ],
                        'catalogos' => $catalogos,
                        'total_registros'=>$total_registros,
                        'total_reg_busqueda'=>$total_reg_busqueda
         ]; 
            
        return response()->json($response);
    }

    public function index()
    {
        $companylist=Company::select("id","razon_social")->where('estado',1)->get();
        return view('catalogo.index',compact('companylist'));
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
        $valor_empresa    =  $request['valor_empresa'];
        $inscrito         =  $request['inscrito'];
        $v_checkbox       =  $request['v_checkbox']; 
        $v_exam           =  $request['v_exam']; 
        
        $resultado=Catalogue::where('company_id', $valor_empresa)->where('estado',1)->count();

        if($resultado==''){
            $catalogue=new Catalogue;
            $catalogue->company_id	=$valor_empresa;
            $catalogue->estado='1';
            $catalogue->save();
            $id_catalogo = Catalogue::select('id')->orderby('created_at','DESC')->first();
            foreach  ($request['v_exam'] as $key => $value){
                $detailCatalogue = new DetailCatalogue;
                $detailCatalogue->catalogue_id=$id_catalogo->id;
                $detailCatalogue->examens_id=$value;
                $detailCatalogue->inscrito=$request['inscrito'][$key];
                $detailCatalogue->estado='1';
                $detailCatalogue->save();
            }
            return response()->json([
                    "mensaje" => "Se registro exitosamente",
                    "tipo"    => "exito"
            ]);
        }else if($resultado!=''){
                return response()->json([
                    "mensaje" => "Ya existe un registro con esta empresa",
                    "tipo"    => "mal"
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
        $inscrito_update     =  $request['inscrito_update'];
        $v_checkbox_up       =  $request['v_checkbox_up']; 
        $v_exam_up           =  $request['v_exam_up']; 

        $id_catalogo=$id;

        $registros=DetailCatalogue::where('catalogue_id',$id_catalogo)->get();
        
        foreach($registros as $registro){
            $ids[]=$registro->id;
        }
        $eliminados = DetailCatalogue::destroy($ids);

        foreach  ($request['v_exam_up'] as $key => $value){
            $detailCatalogue = new DetailCatalogue;
            $detailCatalogue->catalogue_id=$id_catalogo;
            $detailCatalogue->examens_id=$value;
            $detailCatalogue->inscrito=$request['inscrito_update'][$key];
            $detailCatalogue->estado='1';
            $detailCatalogue->save();
        }

        return response()->json([
            "mensaje" => "Se registro exitosamente",
            "tipo"    => "exito"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalogo=Catalogue::find($id); 
        if($catalogo->delete()){
            return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
        }
    }
}
