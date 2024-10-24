@extends('layouts.nuevo')

@section('titulo', 'Contacto')

@section('contenido')
    <h2>Formulario de Contacto</h2>
    <form action="/enviar-contacto" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea><br><br>

        <button type="submit" style="background-color: #ffa500; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer;">
            Enviar
        </button>
    </form>
@endsection
