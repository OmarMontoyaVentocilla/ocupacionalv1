@extends('adminlte::page')
@section('title')Antecedentes @stop
@section('content')


 <antecedentes :valor="{{$valor_orden_antecede}}" :valor2="{{$idpaciente}}"  :doctor="{{$antecedentes_doctores}}">
 </antecedentes>
  

  
@stop
