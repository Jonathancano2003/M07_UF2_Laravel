@extends('layouts.principal')

@section('titulo', 'Total de películas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Total de actores disponibles</h1>
        <p class="text-center">Hay un total de <strong>{{ $count }}</strong> actores en la base de datos .</p>
    </div>
@endsection
