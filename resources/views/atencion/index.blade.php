@extends('adminlte::page')
@section('title')atención @stop
@section('content')

<atencion :company="{{$company}}" :paciente="{{$paciente}}" :examen="{{$tipo_examen}}"></atencion>

@stop