<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function query_search_permiso($valor_caja){
        $valor=Permission::where('name','like','%'.$valor_caja.'%');
        return $valor;
    }

    public function listar(Request $request){
       
        $paginacion = '';
        $valor_combo = $request->get('valor_combo');
        $valor_caja =  $request->get('valor_caja');

        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $permisos=$this->query_search_permiso($valor_caja)
                       ->orderBy('id', 'DESC')
                       ->paginate($paginacion);

       //TOTAL DE REGISTROS
       $total_registros=Permission::count();
       //TOTAL DE REGISTROS EN BUSQUEDA
       $total_reg_busqueda=$this->query_search_permiso($valor_caja)->count();            

    
       $response = [
        'pagination' => [
            'total' => $permisos->total(),
            'current_page' => $permisos->currentPage(),
            'per_page' => $permisos->perPage(),
            'last_page' => $permisos->lastPage(),
            'from' => $permisos->firstItem(),
            'to' => $permisos->lastItem(),
        ],
        'permisos' => $permisos,
        'total_registros'=>$total_registros,
        'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 
        
       return response()->json($response);
   }


     public function index()
    {
        return view('permiso.index');
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
        $this->validate($request, [
            'name'        => 'required|max:255'
        ]);
 
        $permiso = Permission::create([
            'name'        => request('name'),
            'guard_name'  => "web"
        ]);
 
        return response()->json([
            'role'    => $permiso,
            'message' => 'Success'
        ], 200);
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
        $this->validate($request, [
            'name' => 'required|max:255'
    
        ]);
        $permiso=Permission::find($id); 
        $permiso->name = request('name');
        $permiso->save();
 
        return response()->json([
            'message' => 'Se actualizo correctamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso=Permission::find($id); 
        if ($permiso->delete()) {
            return response()->json([
                "success" => true,
                "mensaje" => "Se elimino exitosamente",
            ]);
        }
    }
}
