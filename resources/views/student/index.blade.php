@extends('layouts.invention')

@section('titulo', 'Brows Student ')

@section('contenido')
<h1>Estudiantes</h1>  

<div class="col-md-4">
    <a href="{{ route('students.create') }}" class="btn btn-primary">Agregar Estudiante</a>
</div>

<form action="{{ route('students.filter') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-6">
            <input name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </div>
</form>




@if(session('success'))  
  <div class="alert alert-success">{{ session('success') }}</div>  
@endif

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th>Nombre</th>  
            <th>Correo</th>  
            <th>Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($students as $student)  
            <tr>  
                <td>{{ $student->name }}</td>  
                <td>{{ $student->email }}</td>  
                <td>  
                    <a href="{{ route('students.show', $student) }}" class="btn btn-primary">Ver</a>  
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Confirmar?')">Eliminar</button>  
                    </form>  
                </td>  
            </tr>  
        @endforeach  
    </tbody>  
</table>  

@endsection



