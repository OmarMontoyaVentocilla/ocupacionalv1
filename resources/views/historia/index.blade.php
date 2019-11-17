@extends('adminlte::page')
@section('title')Historia @stop
@section('content')


<historia :valor="{{$valor_orden_historia}}" :valor2="{{$idpaciente}}"  :doctor="{{$historia_doctores}}"></historia>


  
@stop
