<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use RegistersUsers;
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }


    public function query_search($valor_caja){
       $valor= User::where(function($query) use($valor_caja) {
            $query->where('name','like','%'.$valor_caja.'%')
              ->orWhere('email', 'like','%'.$valor_caja.'%');
        })->where(function($query){
            $query->where('estado',1);
        });
        return $valor;
    } 


     public function listar(Request $request){
        //$user=User::select('name')->where('estado',"=",1)->get();
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $user=$this->query_search($valor_caja)
                   ->orderBy('id', 'DESC')
                   ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=User::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
        $total_reg_busqueda=$this->query_search($valor_caja)
             ->count();


         $response = [
             'pagination' => [
                 'total' => $user->total(),
                 'current_page' => $user->currentPage(),
                 'per_page' => $user->perPage(),
                 'last_page' => $user->lastPage(),
                 'from' => $user->firstItem(),
                 'to' => $user->lastItem(),
             ],
             'user' => $user,
             'total_registros'=>$total_registros,
             'total_reg_busqueda'=>$total_reg_busqueda,
         ]; 
         return response()->json($response);
    }


    
     public function index()
    {
        $user = new User;
		return view('usuario.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario= new User;
        $usuario->name=request('nombre_usuario');
        $usuario->email=request('nombre_email');
        $usuario->username= request('clave_nombre_usuario');
        $usuario->password=bcrypt(request('nombre_password'));
        $usuario->estado='1';
         if($usuario->save()){
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
        $user=User::find($id);
        $user->name    = $request->get('nombre_usuario_edit');
        $user->email   = $request->get('nombre_email_edit');
        $user->username= $request->get('clave_nombre_usuario_edit');

        if(Hash::check($request->get('actual_password'), Auth::user()->password)){
        $user->password=bcrypt($request->get('nuevo_password'));  
        }

		if ($user->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se actualizo exitosamente",
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
         $usuario=User::find($id); 
         $usuario->estado = 0;
         if ($usuario->save()) {
			return response()->json([
				"success" => true,
				"mensaje" => "Se elimino exitosamente",
			]);
		}
    }
}
