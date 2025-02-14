<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo - @yield('titulo')
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

    </title>
</head>

<body>
    @section('header')
    <h1>Header</h1>
    <img src="{{asset('header.jpg')}}" alt="">

    @show
    <hr>
    <div class="container">
        @yield('content')
    </div>
    <hr>
 
    @section('footer')
    <h1>PIE DE PAGINA </h1>
   <img src="{{asset('footer.jpg')}}" alt="">
    @show
</body>

</html>