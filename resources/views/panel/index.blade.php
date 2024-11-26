@extends('layouts.invention')

@section('titulo', $titulo)

@section('contenido')

<title>{{ $titulo }}</title>

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
                            <a href="{{ route('panel.show', ['tipo' => 'estudiantes', 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td>   

                    @elseif($tipo === 'materias')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => 'materias', 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($tipo === 'cursos')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject->name ?? 'Sin asignar' }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => 'cursos', 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($tipo === 'profesores')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->specialization }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => 'profesores', 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($tipo === 'comisiones')
                        <td>{{ $item->aula }}</td>
                        <td>{{ $item->horario }}</td>
                        <td>{{ $item->course->name }}</td>
                        <td>
                            @if( $item->professors->isNotEmpty() )
                                @foreach( $item->professors as $professor )
                                    {{ $professor->name }},<br> <!-- Muestra el nombre de cada profesor en una nueva línea -->
                                @endforeach
                            @else
                                No hay profesores asignados.
                            @endif
                        </td>
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
