@extends('adminlte::page')
@section('title')categoria @stop
@section('content')

{{-- @can('destroy_categories');
<ul>
@foreach ($categoria as $cat)
  <li>{{ $cat->nombre_categoria}}</li>	   
@endforeach
  <li>{{$agregar}}</li>
  <li>{{$editar}}</li>
  <li>{{$eliminar}}</li>
</ul> 
<autor :add="{{$agregar}}" :edit="{{$editar}}" :del="{{$eliminar}}" ></autor>
 @else  
<autor :add="{{$agregar=1}}" :edit="{{$editar=1}}" :del="{{$eliminar=1}}"></autor>
 @endcan  --}}

@if(auth()->user()->can('destroy_categories'))
   "BIEN PUEDOO"
 @elseif(auth()->user()->can('destroy_categoriess'))  
   sdsd
 @else
 dfdfdfdfdfdfdf  
@endif
 
@role('Administrador')
    I am a super-admin!
@else
    I am not a super-admin...
@endrole
 
@stop
 