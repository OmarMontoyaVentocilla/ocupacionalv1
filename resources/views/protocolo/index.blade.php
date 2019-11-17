@extends('adminlte::page')
@section('title')protocolo @stop
@section('content')

 <div class="container-fluid">
 <div class="row fondo_pantalla" data-toggle="collapse" data-target="#demop">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
         <i class="fa fa-plus"></i> Nuevo protocolo
    </div>
</div><br>
<div id="demop" class="collapse">
    <protocolo  :company="{{$company}}" :accion="1"></protocolo>
</div>
<div class="row fondo_pantalla" data-toggle="collapse" data-target="#demo2p">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
         <i class="fa fa-plus"></i> Listar protocolo
    </div>
</div>
<div id="demo2p" class="collapse">
    <protocolo  :company="{{$company}}" :accion="2"></protocolo>
</div>
 </div>




@stop