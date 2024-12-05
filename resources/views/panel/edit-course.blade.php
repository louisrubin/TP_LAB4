@extends('layouts.invention')

@section('titulo', $tipo)

@section('contenido')

<h1 style="margin-bottom: 20;">Editando {{ $tipo}}</h1>

<form action="{{ route('courses.update', $course) }}" method="POST">
    @csrf
    @if(isset($course))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">ID</label>
        <input type="text" name="id" class="form-control" value="{{ old('id', $course->id ?? '') }}" disabled>
    </div>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $course->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="courses">Materia asignada</label>
        <div id="data-container">
            <!-- Contenedor para los select dinámicos -->

                <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                    <select name="subject_id" class="form-control mb-2" style="width: 50%;" required>
                        <option value="" disabled selected>Seleccionar Materia</option>
                        @foreach($subjects as $subjectOption)
                            <option value="{{ $subjectOption->id }}" 
                                {{ $course->subject_id == $subjectOption->id ? 'selected' : '' }}>
                                {{ $subjectOption->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr/>

                <label for="courses">Alumnos asignados</label>
                @foreach($course->students as $student)
                    <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                        <select name="students_id[]" class="form-control mb-2" required>
                            <option value="" disabled selected>Seleccionar Alumno</option>
                            @foreach($students as $studentOption)
                                <option value="{{ $studentOption->id }}" 
                                    {{ $studentOption->id == $student->id ? 'selected' : '' }}>
                                    {{ $studentOption->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger btn-sm remove-data">Eliminar</button>
                    </div>
                @endforeach
            
                
        </div>


        <button type="button" id="add-data" class="btn btn-secondary mt-2">Agregar Alumno</button>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>


<a href="{{ url()->previous() }}">
    <button class="btn btn-warning" >Volver</button>
</a>


@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const dataContainer = document.getElementById('data-container');
    const addDataButton = document.getElementById('add-data');

    // Agregar nuevo selector de curso
    addDataButton.addEventListener('click', function () {
        const newDataWrapper = document.createElement('div');
        newDataWrapper.classList.add('data-select-wrapper');

        // Agregar estilos directamente al nuevo div
        newDataWrapper.style.display = 'flex';
        newDataWrapper.style.alignItems = 'center';
        newDataWrapper.style.justifyContent = 'space-between';

        newDataWrapper.innerHTML = `
            
            <select name="students_id[]" class="form-control mb-2" required>
                <option value="" disabled selected>Seleccionar Alumno</option>
                @foreach($students as $studentOption)
                    <option value="{{ $studentOption->id }}" >
                        {{ $studentOption->name }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-data">Eliminar</button>
        `;

        dataContainer.appendChild(newDataWrapper);
    });

    // Eliminar un selector de curso
    dataContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-data')) {
            e.target.closest('.data-select-wrapper').remove();
        }
        });
    });

</script>
