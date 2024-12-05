@extends('layouts.invention')

@section('titulo', $tipo)

@section('contenido')

<h1 style="margin-bottom: 20;">Editando {{ $tipo}}</h1>

<form action="{{ route('commissions.update', $commission) }}" method="POST">
    @csrf
    @if(isset($commission))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">ID</label>
        <input type="text" name="id" class="form-control" value="{{ old('id', $commission->id ?? '' ) }}" disabled>
    </div>

    <div class="form-group">
        <label for="name">Aula</label>
        <input type="text" name="aula" class="form-control" value="{{ old('aula', $commission->aula ?? '' ) }}" required>
    </div>



    <div class="form-group">
        <label for="horario">Horario</label>
        <input type="text" name="horario" class="form-control"
            value="{{ old('horario', $commission->horario ?? '' ) }}" required>
    </div>



    <div class="form-group">
        <label for="courses">Curso asignado</label>
        <div id="data-container">
            <!-- Contenedor para los select dinámicos -->

                <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                    <select name="course_id" class="form-control mb-2" style="width: 50%;" required>
                        <option value="" disabled selected>Seleccionar Curso</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                {{ $commission->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <label for="courses">Profesores asignados</label>

                <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                    <select name="professor_id" class="form-control mb-2" required>
                        <option value="" disabled selected>Seleccionar Profesor</option>
                        @foreach($professors as $professor)
                            <option value="{{ $professor->id }}" 
                                {{ $commission->professor_id == $professor->id ? 'selected' : '' }}>
                                {{ $professor->name }} ({{$professor->specialization}})
                            </option>
                        @endforeach
                    </select>
                </div>

                @foreach($commission->professors as $professor)
                    <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                        <select name="professors_id[]" class="form-control mb-2" required>
                            <option value="" disabled selected>Seleccionar Profesor</option>
                            @foreach($professors as $professor)
                                <option value="{{ $professor->id }}" 
                                    {{ $commission->professor_id == $professor->id ? 'selected' : '' }}>
                                    {{ $professor->name }} ({{$professor->specialization}})
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger btn-sm remove-data">Eliminar</button>
                    </div>
                @endforeach
            
                
        </div>


        <button type="button" id="add-data" class="btn btn-secondary mt-2">Agregar Profesor</button>
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
            
            <select name="professors_id[]" class="form-control mb-2" required>
                <option value="" disabled selected>Seleccionar Profesor</option>
                @foreach($professors as $professor)
                    <option value="{{ $professor->id }}" >
                        {{ $professor->name }} ({{$professor->specialization}})
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
