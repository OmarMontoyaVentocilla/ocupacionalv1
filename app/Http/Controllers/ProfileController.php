<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
class ProfileController extends Controller
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
        $id_perfil = $request->get('id_perfil');
        $perfil=Perfil::where('estado',1)
                        ->where('company_id',$id_perfil)         
                        ->get();
       $response = [
        'perfil'=>$perfil
       ]; 
       return response()->json($response);
    }

    public function index()
    {
        //
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
        $perfil= new Perfil;
        $perfil->descripcion_perfil=request('descripcion');
        $perfil->company_id=request('id_perfil_empresa');
        $perfil->estado="1";
        if($perfil->save()){
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
        $perfil= Perfil::find($id);
        $perfil->estado="0";
        if($perfil->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
             ]);
          }
    }
}
