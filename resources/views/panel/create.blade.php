@extends('layouts.invention')

@section('titulo', 'Registrar '. $tipo )

@section('contenido')

<h1 style="margin-bottom: 20px;">Registrar {{ $tipo }}</h1>

@if ($tipo === 'Estudiantes')
    <form action="{{ route('students.store') }}" method="POST">
@elseif ($tipo === 'Profesores')
    <form action="{{ route('professors.store') }}" method="POST">
@elseif ($tipo === 'Cursos')
    <form action="{{ route('courses.store') }}" method="POST">
@elseif ($tipo === 'Materias')
    <form action="{{ route('subjects.store') }}" method="POST">
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
            
            <label for="commissions_id" style="margin-top: 20px;">Asignar Comisiones</label>
            
            <div id="data-container">
                <!-- SE INSERTA EN EL SCRIPT DE JS AL FINAL DEL BLADE -->
            </div>
            <button type="button" id="add-data" class="btn btn-secondary mt-2">Agregar Comisión</button>
        </div>

    @elseif ($tipo === 'Cursos')
        <div class="form-group">
            <label for="subject_id">Asignar Materia</label>
            <select name="subject_id" class="form-control" style="width: 50%;" required>
                <option value="" disabled selected>Seleccionar Materia</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        
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

    <button type="submit" class="btn btn-primary col-4">Crear {{ $tipo }}</button>
</form>

<a href="{{ url()->previous() }}">
    <button class="btn btn-warning" style="margin-top: 20px;">Volver</button>
</a>

@endsection


@if ($tipo === 'Profesores')
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
                <select name="commissions_id[]" class="form-control mb-2" style="width: 80%" required>
                    <option value="" disabled selected>Seleccionar Comisión</option>
                    @foreach($commissions as $commissionOption)
                        <option value="{{ $commissionOption->id }}" 
                            {{ $commissionOption->id }}>
                            {{ $commissionOption->aula .' ('. $commissionOption->horario .')' }}
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
@endif