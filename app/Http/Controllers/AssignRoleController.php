<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    } 
   
    public function listrole(Request $request){
        $valor_licant=$request->get('valor_licant');
        $valor_liuser=$request->get('valor_liuser');
        
        $users = User::with(['roles'=> function($query){
            $query->where('estado',1)->select("id","name");
        }])->select("id","name")->where('id',$valor_liuser)->get();
    
        $response = [
            'lista'=>$users
        ]; 
        return response()->json($response);

    }

    public function listar(Request $request){
        $total_usuario=User::where('estado',1)->select("id","name")->get();
        $total_roles=Role::where('estado',1)->select("id","name")->get();
        
        $response = [
            'users' => $total_usuario,
            'roles'=>$total_roles
        ]; 
        return response()->json($response);
    }

     public function index()
    {
        return view('asignar.index');
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
        $id=$request->get('usuario');
        $role_name=$request->get('rol');
        $usuario=User::find($id);
        $usuario->assignRole($role_name);
        if ($usuario) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se guardo exitosamente",
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
        $rol_edit_id=$id;
        $roles_arreglo=$request->get('roles_arreglo');
        $usuario=User::find($rol_edit_id);
        $usuario->syncRoles($roles_arreglo);
        if ($usuario) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se guardo exitosamente",
			]);
		}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $valor_nombre_username=$request->get('valor_nombre_username');
        $valor_nombre_rol=$request->get('valor_nombre_rol');
        $usuario=User::find($valor_nombre_username);
        $usuario->removeRole($valor_nombre_rol);
        if ($usuario) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se guardo exitosamente",
			]);
		}
    }
}
