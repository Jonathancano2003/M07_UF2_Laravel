@extends('layouts.principal')

@section('titulo', $title)

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $title }}</h1>

        @if ($actors->isEmpty())
            <div class="alert alert-warning text-center">
                No hay actores en la base de datos.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>País</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actors as $actor)
                            <tr>
                                <td>{{ $actor->name }}</td>
                                <td>{{ $actor->surname }}</td>
                                <td>{{ $actor->birthdate }}</td>
                                <td>{{ $actor->country }}</td>
                                <td>
                                    @if (!empty($actor->img_url))
                                        <img src="{{ $actor->img_url }}" class="img-thumbnail" style="width: 100px; height: 120px;" alt="Imagen de {{ $actor->name }}">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
