@extends('adminlte::page')
@section('title')Triaje @stop
@section('content')


 <triaje :valor="{{$valor_orden_triaje}}" :valor2="{{$idpaciente}}" :atendido="{{$atendido}}"></triaje>
  
</div>
  
@stop