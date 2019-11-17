@extends('adminlte::page')
@section('title')paciente @stop
@section('content')
 
<paciente :pais="{{$pais}}" :departamento="{{$departamento}}"></paciente>
@stop