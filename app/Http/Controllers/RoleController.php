<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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

  public function query_search_role($valor_caja){
      $valor=Role::where('name','like','%'.$valor_caja.'%')->where('estado',1);
      return $valor;
  }

   public function listar(Request $request){
       
        $paginacion = '';
        $valor_combo = $request->get('valor_combo');
        $valor_caja =  $request->get('valor_caja');

        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $roles=$this->query_search_role($valor_caja)
                    ->orderBy('id', 'DESC')
                    ->paginate($paginacion);

       //TOTAL DE REGISTROS
       $total_registros=Role::where('estado',1)->count();
       //TOTAL DE REGISTROS EN BUSQUEDA
       $total_reg_busqueda=$this->query_search_role($valor_caja)->count();            

    
       $response = [
        'pagination' => [
            'total' => $roles->total(),
            'current_page' => $roles->currentPage(),
            'per_page' => $roles->perPage(),
            'last_page' => $roles->lastPage(),
            'from' => $roles->firstItem(),
            'to' => $roles->lastItem(),
        ],
        'roles' => $roles,
        'total_registros'=>$total_registros,
        'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 
        
       return response()->json($response);
   }

    public function index()
    {   
        $rol=Role::where('estado',1)->get();
        return response()->view('role.index',$rol, 200);
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
 
        $role = Role::create([
            'name'        => request('name'),
            'guard_name'  => "web",
            'estado'      =>1
        ]);
 
        return response()->json([
            'role'    => $role,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
         $this->validate($request, [
            'name' => 'required|max:255'
    
        ]);
 
        $role->name = request('name');
        $role->save();
 
        return response()->json([
            'message' => 'Se actualizo correctamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $role->estado = 0;
        if ($role->save()) {
            return response()->json([
                "success" => true,
                "mensaje" => "Se elimino exitosamente",
            ]);
        }
    }
}
