
@extends('layouts.invention')

@section('titulo', 'Estudiante')

@section('contenido')

<form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group">
      <label for="course_id">ID</label>
      <input name="course_id" class="form-control" value="{{ old('id', $student->id ?? '') }}"  readonly>
    </div>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}"  readonly>
    </div>

    <div class="form-group">
        <label for="email">Correo</label>
        <input  name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}"  readonly>
    </div>
    
    <!-- Mostrando los cursos asociados al estudiante -->
    <table class="table">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Materia</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @if($student->courses->isNotEmpty())
                @foreach($student->courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>  
                        <td>{{ $course->subject->name ?? 'Sin materia' }}</td> 
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">Este estudiante no está inscrito en ningún curso.</td>
                </tr>
            @endif
        </tbody>
    </table>
   
</form>

<a href="{{ route('students.edit', $student) }}">
    <button class="btn btn-warning" type="button">Editar</button>
</a>

<a href="{{ url()->previous() }}">
    <button class="btn btn-primary" type="button">Volver</button>
</a>

@endsection
 