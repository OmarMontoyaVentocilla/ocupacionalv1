@extends('adminlte::page')
@section('title')doctor @stop
@section('content')
  {{-- {{$mensaje}} --}}
<doctor :user="{{$usuario}}"></doctor>
  
@stop