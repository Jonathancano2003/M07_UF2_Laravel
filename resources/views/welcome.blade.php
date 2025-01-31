@extends('layouts.principal')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('titulo',"Bienvenido a la página de películas")
    
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body class="container">
    <h1 >Añadir peliculas</h1>
    @if (!empty($status))
        <p style="color: red;">{{ $status }}</p>
    @endif
    <form action="{{ route('createFilm') }}" method="POST">
        {{ csrf_field() }}

        <label for="nombre">Nombre</label>
        <input type="text" name="name" />

        <label for="year">Año</label>
        <input type="number" name="year" />

        <label for="genre">Género</label>
        <input type="text" name="genre" />

        <label for="country">País</label>
        <input type="text" name="country" />

        <label for="duration">Duración</label>
        <input type="number" name="duration" />

        <label for="img_url">URL de Imagen</label>
        <input type="text" name="img_url" />

        <button type="submit">Guardar</button>
    </form>
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href="/filmout/films/year/1994">Peliculas por año</a></li>
        <li><a href="/filmout/films/genre/drama">Peliculas por genre</a></li>
        <li><a href="/filmout/films/count">Contador de peliculas</a></li>

        
    </ul>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>