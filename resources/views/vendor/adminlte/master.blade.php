<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    
    @yield('adminlte_css')

</head>
<body class="hold-transition @yield('body_class')">

<div id="app">
@yield('body')
</div>

<script src="{{ asset('js/app.js') }}"></script>

@yield('adminlte_js')

</body>
</html>
