@extends('adminlte::page')
@section('title')autor @stop
@section('content')
 
{{-- <example :message="'{{json_encode($resp)}}'" :cadena="'{{$string}}'"></example>  --}}
<autor :edit="1"></autor>

@stop
