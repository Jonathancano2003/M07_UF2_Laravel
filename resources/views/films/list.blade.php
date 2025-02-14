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
                                <td>{{ $film['name'] }}</td>
                                <td>{{ $film['year'] }}</td>
                                <td>{{ $film['genre'] }}</td>
                                <td>
                                    <img src="{{ $film['img_url'] }}" class="img-thumbnail" style="width: 100px; height: 120px;" alt="Imagen de {{ $film['name'] }}">
                                </td>
                                <td>{{ $film['country'] }}</td>
                                <td>{{ $film['duration'] }} minutos</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
