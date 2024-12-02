@extends('layouts.invention')

@section('titulo', 'Nuevo '. $tipo )

@section('contenido')

<h1 style="margin-bottom: 20px;">Registrar {{ $tipo }}</h1>

@if ($tipo === 'Estudiantes')
    <form action="{{ route('students.store') }}" method="POST">
@elseif ($tipo === 'Profesores')
    <form action="{{ route('professors.store') }}" method="POST">
@elseif ($tipo === 'Cursos')
    <form action="{{ route('students.store') }}" method="POST">
@elseif ($tipo === 'Materias')
    <form action="{{ route('students.store') }}" method="POST">
@elseif ($tipo === 'Comisiones')
    <form action="{{ route('students.store') }}" method="POST">
@endif

    @csrf

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="" required>
    </div>

    @if ($tipo === 'Estudiantes')
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" name="email" class="form-control" value="" required>
        </div>

    @elseif ($tipo === 'Profesores')
        <div class="form-group">
            <label for="email">Especialización</label>
            <input type="text" name="specialization" class="form-control" value="" required>
        </div>

    @elseif ($tipo === 'Cursos')

    @elseif ($tipo === 'Materias')
    
    @elseif ($tipo === 'Comisiones')
        <div class="form-group">
            <label for="email">Nro. Aula</label>
            <input type="text" name="aula" class="form-control" value="" required>
        </div>
        <div class="form-group">
            <label for="email">Horario</label>
            <input type="text" name="horario" class="form-control" value="" required>
        </div>

    @endif
    
    

    <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Create' }}</button>
</form>


<a href="{{ url()->previous() }}">
    <button class="btn btn-warning" >Volver</button>
</a>

@endsection

