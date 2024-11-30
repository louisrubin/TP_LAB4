@extends('layouts.invention')

@section('titulo', $titulo)

@section('contenido')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<title>{{ $titulo }}</title>

<div class="container">
    <h1>{{ $titulo }}</h1>
    <div class="col-md-4">
        <a href="{{ route('students.create') }}" class="btn btn-primary" style="color: white";>Agregar {{ $titulo }}</a>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin: 20px 0; ">
      
    @if ($titulo == 'Estudiantes')
        <form action="{{ route('Estudiantes.filter') }}" method="GET" class="mb-4">
    @elseif ($titulo == 'Profesores')
        <form action="{{ route('Profesores.filter') }}" method="GET" class="mb-4">
    @elseif ($titulo == 'Materias')
        <form action="{{ route('Materias.filter') }}" method="GET" class="mb-4">
    @elseif ($titulo == 'Cursos')
        <form action="{{ route('Cursos.filter') }}" method="GET" class="mb-4">
    @elseif ($titulo == 'Comisiones')
        <form action="{{ route('Comisiones.filter') }}" method="GET" class="mb-4">
    @endif
            <div class="row">
                <div class="col-md-8">
                    <input name="name" class="form-control" placeholder="Buscar {{ $data->name ?? 'por nombre' }}" value="{{ request('name') }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>    



    <table class="table">
        <thead>
            <tr>
                @if($titulo === 'Estudiantes')
                    <th>Nombre</th>
                    <th>Correo</th>
                @elseif($titulo === 'Materias')
                    <th>ID</th>
                    <th>Nombre</th>
                @elseif($titulo === 'Cursos')
                    <th>Nombre</th>
                    <th>Materia</th>
                @elseif($titulo === 'Profesores')
                    <th>Nombre</th>
                    <th>Especialización</th>
                @elseif($titulo === 'Comisiones')
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
                    @if($titulo === 'Estudiantes')
                        <td>{{ $item->name }}</td>  
                        <td>{{ $item->email }}</td>  
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => $titulo, 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td>   

                    @elseif($titulo === 'Materias')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => $titulo, 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($titulo === 'Cursos')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject->name ?? 'Sin asignar' }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => $titulo, 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($titulo === 'Profesores')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->specialization }}</td>
                        <td>  
                            <a href="{{ route('panel.show', ['tipo' => $titulo, 'id' => $item->id ] ) }}" class="btn btn-primary">Ver</a>  
                            <form action="{{ route('students.destroy', $item) }}" method="POST" style="display:inline-block;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                            </form>  
                        </td> 
                    @elseif($titulo === 'Comisiones')
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
                    <td colspan="3">No se encontraron {{$titulo}}.</td>
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
