@extends('adminlte::page')
@section('title')catalogo de empresa @stop
@section('content')
<div class="container-fluid">
    <div class="row fondo_pantalla" data-toggle="collapse" data-target="#democ">
       <div class="col-lg-12 col-md-12 col-sm-12 ">
            <i class="fa fa-plus"></i> Nuevo catálogo
       </div>
   </div><br>
   <div class="row fondo_pantalla" data-toggle="collapse" data-target="#demo2c">
       <div class="col-lg-12 col-md-12 col-sm-12 ">
            <i class="fa fa-plus"></i> Listar catálogo
       </div>
   </div>
</div>
<div id="democ" class="collapse">
    <catalogo :company="{{$companylist}}" :accion="1"></catalogo>
</div>
<div id="demo2c" class="collapse">
    <catalogo :company="{{$companylist}}" :accion="2"></catalogo>
</div>

@stop