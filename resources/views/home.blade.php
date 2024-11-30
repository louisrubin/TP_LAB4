@extends('layouts.invention')

@section('titulo', 'Inicio')

@section('contenido')
<h1>Inicio</h1>  

<ul>
    <a href="{{ route('panel.index', 'Estudiantes') }}"><h5>Estudiantes</h5></a>
    <a href="{{ route('panel.index', 'Profesores') }}"><h5>Profesores</h5></a>
    <a href="{{ route('panel.index', 'Materias') }}"><h5>Materias</h5></a>
    <a href="{{ route('panel.index', 'Cursos') }}"><h5>Cursos</h5></a>
    <a href="{{ route('panel.index', 'Comisiones') }}"><h5>Comisiones</h5></a>
</ul>

@endsection



