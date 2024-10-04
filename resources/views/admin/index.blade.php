@extends('adminlte::page')

@section('title', 'Panel de administracion')

@section('content_header')
    <h1>Panel de administración</h1>
@stop

@section('content')
    <p>¡Hola! {{Auth::user()->full_name}}, desde aquí podrás administrar tus artículos,
        comentarios y categorías.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop