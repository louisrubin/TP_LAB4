@extends('layouts.invention')

@section('titulo', $titulo)

@section('contenido')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div style="display: flex; align-items: center; justify-content: space-between; margin: 20px 0;">
    <h1 style="margin: 0;">{{ $titulo ?? 'Información Detallada' }}</h1>
    
    <a href="{{ route('panel.edit', ['tipo' => $titulo, 'id' => $data->id ] ) }}">
        <button class="btn btn-primary">Editar {{ $titulo }}</button>
    </a>
</div>


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
        <h2>Cursos y Materias</h2>
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

<!-- ####################################################################################### -->


    {{-- Profesores --}}
    @elseif ($titulo === 'Profesor')
        <h2>Información del Profesor</h2>

        <!-- Mostrando el ID del profesor -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialización</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->specialization }}</td>
                </tr>
            </tbody>
        </table>


        <!-- Mostrando el cursos del profesor -->
        <h2>Aulas y Cursos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aula</th>
                    <th>Curso</th>
                    <th>Horario</th>
                </tr>
            </thead>
            @forelse ($data->commissions as $commission)
                <tbody>
                    <tr>
                        <td>{{ $commission->id }}</td>
                        <td>{{ $commission->aula }}</td>
                        <td>{{ $commission->course->name }}</td>
                        <td>{{ $commission->horario }}</td>
                    </tr>
                </tbody>
            @empty
                <p>El profesor no está asignado a nigún curso.</p>
            @endforelse
        </table>





    {{-- Materias --}}
    @elseif ($titulo === 'Materia')
        <h2>Información de la Materia</h2>

        <!-- Mostrando el  -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                </tr>
            </tbody>
        </table>


        <!-- Mostrando el  -->
        <h2>Cursos asociados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            @forelse ($data->courses as $course)
                <tbody>
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                    </tr>
                </tbody>
            @empty
                <p>Sin asignar.</p>
            @endforelse
        </table>




    {{-- Cursos --}}
    @elseif ($titulo === 'Curso')
        <h2>Información del Curso</h2>

        <!-- Mostrando el  -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Materia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->subject->name }}</td>
                </tr>
            </tbody>
        </table>


        <!-- Mostrando comisiones  -->
        <h2>Alumnos asociadas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            @forelse ($data->students as $student)
                <tbody>
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <a href="{{ route('panel.show', ['tipo' => 'Estudiantes', 'id' => $student->id ] ) }}" class="btn btn-primary"
                                >Ver</a>  
                        </td>
                    </tr>
                </tbody>
            @empty
                <p>Sin alumnos asignados.</p>
            @endforelse
        </table>






    {{-- Comisiones --}}
    @elseif ($titulo === 'Comision')
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

    <a href="{{ url()->previous() }}">
        <button class="btn btn-secondary">Volver</button>
    </a>
</div>


@endsection
