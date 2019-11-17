@extends('adminlte::page')
@section('title')empresa @stop
@section('content')
 
 {{-- <example :message="'{{json_encode($resp)}}'" :cadena="'{{$string}}'"></example>  --}}
 <div class="container-fluid">
 <div class="row fondo_pantalla" data-toggle="collapse" data-target="#demo">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
         <i class="fa fa-plus"></i> Nueva empresa
    </div>
</div><br>
<div class="row fondo_pantalla" data-toggle="collapse" data-target="#demo2">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
         <i class="fa fa-plus"></i> Listar empresa
    </div>
</div>
 </div>
<div id="demo" class="collapse">
    <empresa :usuarios="{{$users}}" :departamento="{{$departamento}}" :accion="1"></empresa>
</div>
<div id="demo2" class="collapse">
    <empresa :usuarios="{{$users}}" :departamento="{{$departamento}}" :accion="2"></empresa>
</div>
@stop