@extends('layouts.invention')

@section('titulo', $tipo)

@section('contenido')

<h1 style="margin-bottom: 20;">Editando {{ $tipo}}</h1>

<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">ID</label>
        <input type="text" name="id" class="form-control" value="{{ old('name', $student->id ?? '') }}" required readonly>
    </div>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="courses">Asignar Cursos</label>
        <div id="courses-container">
            <!-- Contenedor para los select dinámicos -->
            @foreach($student->courses as $course)
                <div class="course-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                    <select name="course_id[]" class="form-control mb-2" required>
                        <option value="" disabled selected>Selecciona un curso</option>
                        @foreach($courses as $courseOption)
                            <option value="{{ $courseOption->id }}" 
                                {{ $courseOption->id == $course->id ? 'selected' : '' }}>
                                {{ $courseOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-sm remove-course">Eliminar</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-course" class="btn btn-secondary mt-2">Agregar otro curso</button>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Create' }}</button>
</form>


<a href="{{ url()->previous() }}">
    <button class="btn btn-warning" >Volver</button>
</a>


@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const coursesContainer = document.getElementById('courses-container');
    const addCourseButton = document.getElementById('add-course');

    // Agregar nuevo selector de curso
    addCourseButton.addEventListener('click', function () {
        const newCourseWrapper = document.createElement('div');
        newCourseWrapper.classList.add('course-select-wrapper');

        // Agregar estilos directamente al nuevo div
        newCourseWrapper.style.display = 'flex';
        newCourseWrapper.style.alignItems = 'center';
        newCourseWrapper.style.justifyContent = 'space-between';

        newCourseWrapper.innerHTML = `
            <select name="course_id[]" class="form-control mb-2" required>
                <option value="" disabled selected>Selecciona un curso</option>
                @foreach($courses as $courseOption)
                    <option value="{{ $courseOption->id }}">{{ $courseOption->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-course">Eliminar</button>
        `;

        coursesContainer.appendChild(newCourseWrapper);
    });

    // Eliminar un selector de curso
    coursesContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-course')) {
            e.target.closest('.course-select-wrapper').remove();
        }
        });
    });

</script>
