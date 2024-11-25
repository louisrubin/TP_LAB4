@extends('layouts.invention')

@section('titulo', 'Brows Student ')

@section('contenido')
<h1>Students</h1>  
<a href="{{ route('students.create') }}" class="btn btn-primary">Agregar Estudiante</a>

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
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Eliminar</button>  
                    </form>  
                </td>  
            </tr>  
        @endforeach  
    </tbody>  
</table>  

@endsection



