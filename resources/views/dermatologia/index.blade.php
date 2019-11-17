@extends('adminlte::page')
@section('title')dermatologia @stop
@section('content')


 <dermatologia :valor="{{$valor_orden_derma}}" :valor2="{{$idpaciente}}" :atendido="{{$atendido}}" :doctor="{{$dermatologia_doctores}}">
 </dermatologia>
  
</div>
  
@stop

