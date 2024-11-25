@extends('layouts.invention')

@section('titulo', 'Inicio')

@section('contenido')
<h1>Inicio</h1>  

<ul>
    <a href="{{ route('students.section') }}"><h5>Estudiantes</h5></a>
    <a href=""><h5>Materias</h5></a>
    <a href=""><h5>Cursos</h5></a>
    <a href=""><h5>Comisiones</h5></a>
    <a href=""><h5>Profesores</h5></a>
</ul>

@endsection



