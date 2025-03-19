@extends('layouts.principal')

@section('titulo', 'Total de películas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Total de películas disponibles</h1>
        <p class="text-center">Hay un total de <strong>{{ $count }}</strong> películas en la base de datos y JSON.</p>
    </div>
@endsection
