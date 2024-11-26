@extends('layouts.invention')

@section('titulo', 'Inicio')

@section('contenido')
<h1>Inicio</h1>  

<ul>
    <a href="{{ route('panel.index', 'alumnos') }}"><h5>Estudiantes</h5></a>
    <a href="{{ route('panel.index', 'profesores') }}"><h5>Profesores</h5></a>
    <a href="{{ route('panel.index', 'materias') }}"><h5>Materias</h5></a>
    <a href="{{ route('panel.index', 'cursos') }}"><h5>Cursos</h5></a>
    <a href="{{ route('panel.index', 'comisiones') }}"><h5>Comisiones</h5></a>
</ul>

@endsection



