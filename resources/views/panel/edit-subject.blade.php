@extends('layouts.invention')

@section('titulo', $tipo)

@section('contenido')

<h1 style="margin-bottom: 20;">Editando {{ $tipo}}</h1>

<form action="{{ route('subjects.update', $subject) }}" method="POST">
    @csrf
    @if(isset($subject))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">ID</label>
        <input type="text" name="id" class="form-control" value="{{ old('id', $subject->id ?? '') }}" disabled>
    </div>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
   
</form>

<a href="{{ url()->previous() }}">
    <button class="btn btn-warning" >Volver</button>
</a>

@endsection