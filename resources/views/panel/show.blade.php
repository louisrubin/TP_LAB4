@extends('layouts.invention')

@section('titulo', $titulo ?? 'Detalle')

@section('contenido')

<h1>{{ $titulo ?? 'Información Detallada' }}</h1>

<div class="container">
    {{-- Estudiantes --}}
    @if ($titulo === 'Estudiante')
        <h2>Información del Estudiante</h2>


        <!-- Mostrando el ID del estudiante -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                </tr>
            </tbody>
        </table>

        
        <!-- Mostrando el cursos del estudiante -->
        <h2>Sus Cursos y Materias</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Materia</th>
                </tr>
            </thead>
            @forelse ($data->courses as $course)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->subject->name }}</td>
                    </tr>
                </tbody>
            @empty
                <p>El estudiante no está inscrito en ningún curso.</p>
            @endforelse
        </table>













    {{-- Profesores --}}
    @elseif ($titulo === 'profesores')
        <h2>Información del Profesor</h2>
        <p><strong>Nombre:</strong> {{ $data->name }}</p>
        <p><strong>Comisiones Asignadas:</strong></p>
        <ul>
            @forelse ($data->commissions as $commission)
                <li>{{ $commission->name }} (Curso: {{ $commission->course->name ?? 'Sin Curso' }})</li>
            @empty
                <li>No tiene comisiones asignadas.</li>
            @endforelse
        </ul>

    {{-- Materias --}}
    @elseif ($titulo === 'materias')
        <h2>Información de la Materia</h2>
        <p><strong>Nombre:</strong> {{ $data->name }}</p>
        <p><strong>Cursos Asociados:</strong></p>
        <ul>
            @forelse ($data->courses as $course)
                <li>{{ $course->name }}</li>
            @empty
                <li>No tiene cursos asociados.</li>
            @endforelse
        </ul>

    {{-- Cursos --}}
    @elseif ($titulo === 'cursos')
        <h2>Información del Curso</h2>
        <p><strong>Nombre:</strong> {{ $data->name }}</p>
        <p><strong>Materia:</strong> {{ $data->subject->name ?? 'Sin Materia Asociada' }}</p>
        <p><strong>Comisiones:</strong></p>
        <ul>
            @forelse ($data->commissions as $commission)
                <li>{{ $commission->name }}</li>
            @empty
                <li>No tiene comisiones asignadas.</li>
            @endforelse
        </ul>

    {{-- Comisiones --}}
    @elseif ($titulo === 'comisiones')
        <h2>Información de la Comisión</h2>
        <p><strong>Nombre:</strong> {{ $data->name }}</p>
        <p><strong>Curso:</strong> {{ $data->course->name ?? 'Sin Curso Asociado' }}</p>
        <p><strong>Profesores:</strong></p>
        <ul>
            @forelse ($data->professors as $professor)
                <li>{{ $professor->name }}</li>
            @empty
                <li>No tiene profesores asignados.</li>
            @endforelse
        </ul>

    {{-- Entidad no reconocida --}}
    @else
        <h2>Entidad no reconocida</h2>
        <p>No hay información disponible para esta entidad.</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
</div>


@endsection
