<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obra;

class ObraController extends Controller
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
       $id_obra = $request->get('id_obra');
       $obra=Obra::where('estado',1)
                  ->where('company_id',$id_obra)  
                  ->get();
       $response = [
        'obra'=>$obra
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
        $obra= new Obra;
        $obra->descripcion_obra=request('descripcion');
        $obra->company_id=request('id_obra_empresa');
        $obra->estado="1";
        if($obra->save()){
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
        $obra= Obra::find($id);
        $obra->estado="0";
        if($obra->save()){
            return response()->json([
        		"success" => true,
		 		"mensaje" => "Se registro exitosamente",
             ]);
          }

    }
}
