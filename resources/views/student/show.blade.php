
@extends('layouts.invention')

@section('titulo', 'Notas ')

@section('contenido')

<form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}"  readonly>
    </div>

    <div class="form-group">
        <label for="email">Correo</label>
        <input  name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}"  readonly>
    </div>
    <div class="form-group">
      <label for="course_id">Curso id</label>
      <input name="course_id" class="form-control" value="{{ old('course_id', $student->course_id ?? '') }}"  readonly>
  </div>
   
</form>


<a href="{{ url()->previous() }}">
    <button class="btn btn-primary" type="button">Volver</button>
</a>

@endsection
