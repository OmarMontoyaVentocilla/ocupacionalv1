<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use Image;
use Storage;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function querySearchDoctor($valor_caja){
        $valor=Doctor::join('users', 'users.id', '=', 'doctors.idsuariod')
            ->select('doctors.id','idsuariod','name','cmp','firma')
            ->where(function($query) use($valor_caja) {
                $query->where('name','like','%'.$valor_caja.'%')
                  ->orWhere('cmp', 'like','%'.$valor_caja.'%');
            })->where(function($query){
               $query->where('doctors.estado',1);
            });
        return $valor;
    }
    
     public function listar(Request $request){
    
                     
        $paginacion = '';
		$valor_combo = $request->get('valor_combo');
		$valor_caja =  $request->get('valor_caja');
      
        $paginacion = ($valor_combo == '') ? 0 : $valor_combo;
        $doctor=$this->querySearchDoctor($valor_caja)
                           ->orderBy('doctors.id', 'DESC')
                          ->paginate($paginacion);

         //TOTAL DE REGISTROS
         $total_registros=Doctor::where('estado',1)->count();
         //TOTAL DE REGISTROS EN BUSQUEDA
         $total_reg_busqueda=$this->querySearchDoctor($valor_caja)
                                  ->count();

        $response = [
            'pagination' => [
                'total' => $doctor->total(),
                'current_page' => $doctor->currentPage(),
                'per_page' => $doctor->perPage(),
                'last_page' => $doctor->lastPage(),
                'from' => $doctor->firstItem(),
                'to' => $doctor->lastItem(),
            ],
            'doctor' => $doctor,
            'total_registros'=>$total_registros,
            'total_reg_busqueda'=>$total_reg_busqueda,
        ]; 

        return response()->json($response);
    }
    
    
     public function index()
    {
        $usuario=User::where('estado','1')->get();
        return view('doctor.index',compact('usuario'));
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
           
        
        // $rules=[
        //     'nombre_doctor'        => 'required|max:250',
        //     // 'image' => 'required|image|mimes:jpg,jpeg,png'
        // ];

        // $messages = [
        //     'nombre_doctor.required'    => 'El campo es obligatorio',
        //     'nombre_doctor.max'         => 'El campo debe tener como maximo 250 caracteres',
        // ];
        
        // $this->validate($request,$rules,$messages);
        
        $usuarioid=Doctor::where('estado','1')->where('idsuariod',request('nombre_doctor'))->count();
        if($usuarioid==''){
            $doctor= new Doctor;
            $doctor->idsuariod= request('nombre_doctor');
            request('cmp')=='' ? $doctor->cmp='' : $doctor->cmp=request('cmp');
            $imgen_all=$request->get('image');      
            list($type,$imagenData)=explode(';',$imgen_all);
            list(,$extension)=explode('/',$type);
            list(,$imagenData)=explode(',',$imagenData); 
            $filename=uniqid().".".$extension;
            $destionation_path=public_path('img/'.$filename);
            Image::make($imgen_all)->resize(100,100)->save($destionation_path);
            $doctor->firma=$filename;
            $doctor->estado='1';
            if($doctor->save()){
                return response()->json([       
                    "tipo" => "success",
                     "mensaje" => "Se registro exitosamente",
                 ]);
              }
        }else if($usuarioid!=''){
                return response()->json([
                    "tipo" => "error",
                    "mensaje" => "Ya asigno a este usuario como doctor",
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
        // $rules=[
        //     'nombre_doctor'        => 'required|max:250'
        // ];

        // $messages = [
        //     'nombre_doctor.required'    => 'El campo es obligatorio',
        //     'nombre_doctor.max'         => 'El campo debe tener como maximo 250 caracteres'
        // ];
        
        // $this->validate($request,$rules,$messages);
        $doctor=Doctor::find($id);
        $imgen_all=$request->get('image_update');   
        if($imgen_all!=''){        
            $doctor->idsuariod= request('nombre_doctor');
            request('cmp')=='' ? $doctor->cmp='' : $doctor->cmp=request('cmp');
            Storage::delete($doctor->firma); 
            list($type,$imagenData)=explode(';',$imgen_all);
            list(,$extension)=explode('/',$type);
            list(,$imagenData)=explode(',',$imagenData); 
            $filename=uniqid().".".$extension;
            $destionation_path=public_path('img/'.$filename);
            Image::make($imgen_all)->resize(100,100)->save($destionation_path);
            $doctor->firma=$filename;
            $doctor->estado='1';
            if($doctor->save()){
               return response()->json([
                   "success" => true,
                    "mensaje" => "Se registro exitosamente",
                ]);
            }
        }else if($imgen_all==''){
            $doctor->idsuariod= request('nombre_doctor');
            request('cmp')=='' ? $doctor->cmp='' : $doctor->cmp=request('cmp');
            //SELECCIONO EL NOMBRE DE ESA IMAGEN
            $imgname=Doctor::where('id',$id)->where('estado',1)->select('firma')->get();
            $doctor->firma=$imgname[0]->firma;
            $doctor->estado='1';
            if($doctor->save()){
                return response()->json([
                    "success" => true,
                     "mensaje" => "Se registro exitosamente",
                 ]);
             }

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
        $doctor=Doctor::find($id);
        Storage::delete($doctor->firma); 
        $doctor->estado = 0;
        if ($doctor->save()) {
           return response()->json([
               "success" => true,
               "mensaje" => "Se elimino exitosamente",
           ]);
       }
    }
}
