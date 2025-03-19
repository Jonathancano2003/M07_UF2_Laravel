@extends('layouts.principal')

@section('titulo', 'Bienvenido a la página de películas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($films))
            <div class="alert alert-warning text-center">
                No se ha encontrado ninguna película.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Año</th>
                            <th>Género</th>
                            <th>Imagen</th>
                            <th>País</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($films as $film)
                            <tr>
                                <td>{{ is_array($film) ? $film['name'] : $film->name }}</td>
                                <td>{{ is_array($film) ? $film['year'] : $film->year }}</td>
                                <td>{{ is_array($film) ? $film['genre'] : $film->genre }}</td>
                                <td>
                                    @php
                                        $imgUrl = is_array($film) ? ($film['img_url'] ?? null) : ($film->img_url ?? null);
                                    @endphp
                                    @if ($imgUrl)
                                        <img src="{{ $imgUrl }}" class="img-thumbnail" style="width: 100px; height: 120px;" alt="Imagen de {{ is_array($film) ? $film['name'] : $film->name }}">
                                    @endif
                                </td>
                                <td>{{ is_array($film) ? $film['country'] : $film->country }}</td>
                                <td>{{ is_array($film) ? $film['duration'] : $film->duration }} minutos</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
