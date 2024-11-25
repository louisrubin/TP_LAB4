@extends('layouts.invention')

@section('titulo', 'Notas ')

@section('contenido')

<h1>{{ isset($student) ? 'Editar' : 'Crear' }}</h1>

<form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
    </div>
    <div class="form-group">
      <label for="course_id">Curso id</label>
      <!-- <input type="course_id" name="course_id" class="form-control" value="{{ old('course_id', $student->course_id ?? '') }}" required>
        -->
        <select name="course_id" class="form-control" required>
            <option value="" disabled selected>Selecciona un curso</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" 
                    {{ isset($student) && $student->courses->contains($course->id) ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Create' }}</button>
</form>

@endsection

