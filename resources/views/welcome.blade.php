@extends('layouts.principal')

@section('titulo', 'Bienvenido a la página de películas')

@section('header')
    @parent
    <h2>Header de la página de películas</h2>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

@stop  

@section('content')
    <h1>Añadir películas</h1>
    @if (!empty($status))
        <p style="color: red;">{{ $status }}</p>
    @endif

    <h1 class="mt-4">Lista de Películas</h1>
    <ul>
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/films">Pelis</a></li>
        <li><a href="/filmout/films/year/1994">Películas por año</a></li>
        <li><a href="/filmout/films/genre/drama">Películas por género</a></li>
        <li><a href="/filmout/films/count">Contador de películas</a></li>
    </ul>

    <form action="{{ route('createFilm') }}" method="POST">
        {{ csrf_field() }}

        <label for="nombre">Nombre</label>
        <input type="text" name="name" /><br>

        <label for="year">Año</label>
        <input type="number" name="year" /><br>

        <label for="genre">Género</label>
        <input type="text" name="genre" /><br>

        <label for="country">País</label>
        <input type="text" name="country" /><br>

        <label for="duration">Duración</label>
        <input type="number" name="duration" /><br>

        <label for="img_url">URL de Imagen</label>
        <input type="text" name="img_url" /><br>

        <button type="submit">Guardar</button>
    </form>
@stop

@section('footer')
    @parent
@stop
