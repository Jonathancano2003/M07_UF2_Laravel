@extends('layouts.principal')

<<<<<<< HEAD
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
=======
@section('titulo', 'Añadir Películas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Añadir Películas</h1>

        @if (!empty($status))
            <div class="alert alert-info">{{ $status }}</div>
        @endif

        <form action="{{ route('createFilm') }}" method="POST" class="mb-5">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" name="year" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="genre">Género</label>
                <input type="text" name="genre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="country">País</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="duration">Duración (minutos)</label>
                <input type="number" name="duration" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="img_url">URL de Imagen</label>
                <input type="text" name="img_url" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <h2 class="text-center mb-4">Lista de Películas</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="/filmout/oldFilms">Pelis antiguas</a></li>
            <li class="list-group-item"><a href="/filmout/newFilms">Pelis nuevas</a></li>
            <li class="list-group-item"><a href="/filmout/films">Pelis</a></li>
            <li class="list-group-item"><a href="/filmout/films/year/1994">Películas por año</a></li>
            <li class="list-group-item"><a href="/filmout/films/genre/drama">Películas por género</a></li>
            <li class="list-group-item"><a href="/filmout/films/count">Contador de películas</a></li>
        </ul>
    </div>
@endsection
>>>>>>> 9f8c1fc8502874d77e6ec688f10ee9ca4314ec2c
