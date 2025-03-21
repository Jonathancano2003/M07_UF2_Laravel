@extends('layouts.principal')

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

    <h2 class="text-center mb-4">Lista de Actores</h2>
    <ul class="list-group">
        <li class="list-group-item"><a href="/actors/list">Lista de actores</a></li>
        <li class="list-group-item"><a href="/actors/count">Contador de actores</a></li>
    </ul>

    <h2 class="text-center mb-4">Filtrar Actores por Década</h2>
    <form action="{{ route('listActorsByDecade', ['year' => request('year', 2000)]) }}" method="GET" class="mb-4">
        <label for="decade">Selecciona una década:</label>
        <select name="year" id="decade" class="form-control">
            <option value="">Seleccionar...</option>
            @for ($year = 1900; $year <= date('Y'); $year += 10)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                    {{ $year }} - {{ $year + 9 }}
                </option>
            @endfor
        </select>
        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
    </form>
</div>
@endsection
