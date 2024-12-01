@extends('layouts.invention')

@section('titulo', $tipo)

@section('contenido')

<h1 style="margin-bottom: 20;">Editando {{ $tipo}}</h1>

<form action="{{ route('professors.update', $professor) }}" method="POST">
    @csrf
    @if(isset($professor))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">ID</label>
        <input type="text" name="id" class="form-control" value="{{ old('id', $professor->id ?? '') }}" required readonly>
    </div>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $professor->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Especialización</label>
        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $professor->specialization ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="commissions">Asignar {{ $tablaRelacion }}</label>
        <div id="data-container">
            <!-- Contenedor para los select dinámicos -->
            @foreach($professor->commissions as $commission)
                <div class="data-select-wrapper" style="display: flex; align-items: center; justify-content: space-between; ">
                    <select name="commissions_id[]" class="form-control mb-2" required>
                        <option value="" disabled selected>Seleccionar {{ $tablaRelacion }}</option>
                        @foreach($commissions as $commissionOption)
                            <option value="{{ $commissionOption->id }}" 
                                {{ $commissionOption->id == $commission->id ? 'selected' : '' }}>
                                {{ $commissionOption->aula .' ('. $commissionOption->horario.')' }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-sm remove-data">Eliminar</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-data" class="btn btn-secondary mt-2">Agregar otra comisión</button>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($professor) ? 'Update' : 'Create' }}</button>
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
            <select name="commissions_id[]" class="form-control mb-2" required>
                <option value="" disabled selected>Seleccionar {{ $tablaRelacion }}</option>
                @foreach($commissions as $commissionOption)
                    <option value="{{ $commissionOption->id }}" 
                        {{ $commissionOption->id == $commission->id ? 'selected' : '' }}>
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
