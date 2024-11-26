@extends('layouts.invention')

@section('contenido')

<div class="container">
    <h1>{{ $titulo }}</h1>
    
<div class="col-md-4">
    <a href="{{ route('students.create') }}" class="btn btn-primary" style="color: white";>Agregar {{ $titulo }}</a>
</div>
    <table class="table">
        <thead>
            <tr>
                @if($tipo === 'alumnos')
                    <th>Nombre</th>
                    <th>Correo</th>
                @elseif($tipo === 'materias')
                    <th>ID</th>
                    <th>Nombre</th>
                @elseif($tipo === 'cursos')
                    <th>Nombre</th>
                    <th>Materia</th>
                @elseif($tipo === 'profesores')
                    <th>Nombre</th>
                    <th>Especialización</th>
                @elseif($tipo === 'comisiones')
                    <th>Aula</th>
                    <th>Horario</th>
                    <th>Curso</th>
                    <th>Profesor</th>
                @endif
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    @if($tipo === 'alumnos')
                        <td>{{ $item->name }}</td>  
                        <td>{{ $item->email }}</td>  
                        <td>  
                            <a href="{{ route('students.show', $item) }}" class="btn btn-primary">Ver</a>  
                            <a href="{{ route('students.edit', $item) }}" class="btn btn-warning">Editar</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td>   

                    @elseif($tipo === 'materias')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                    @elseif($tipo === 'cursos')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject->name ?? 'Sin asignar' }}</td>
                    @elseif($tipo === 'profesores')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->specialization }}</td>
                    @elseif($tipo === 'comisiones')
                        <td>{{ $item->aula }}</td>
                        <td>{{ $item->horario }}</td>
                        <td>{{ $item->course_id }}</td>
                        <td>{{ $item->professor_id }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron {{titulo}}.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="pagination justify-content-center">
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
</div>


@endsection
