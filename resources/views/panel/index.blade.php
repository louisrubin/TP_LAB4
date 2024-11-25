@extends('layouts.invention')

@section('contenido')

<div class="container">
    <h1>{{ $titulo }}</h1>
    
<div class="col-md-4">
    <a href="{{ route('students.create') }}" class="btn btn-primary" style="color: white";>Agregar Estudiante</a>
</div>
    <table class="table">
        <thead>
            <tr>
                @if($tipo === 'alumnos')
                    <th>Nombre</th>
                    <th>Correo</th>
                @elseif($tipo === 'materias')
                    <th>Nombre</th>
                    <th>Descripción</th>
                @elseif($tipo === 'cursos')
                    <th>Nombre</th>
                    <th>Materia</th>
                @elseif($tipo === 'profesores')
                    <th>Nombre</th>
                    <th>Correo</th>
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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    @elseif($tipo === 'cursos')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject->name ?? 'Sin asignar' }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    @elseif($tipo === 'profesores')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron registros</td>
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
