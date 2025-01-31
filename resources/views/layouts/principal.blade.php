<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo - @yield('titulo')

    </title>
</head>

<body>
    @section('header')
    <h1>Header</h1>
    @show
    <hr>
    <div class="container">
        @yield('content')
    </div>
    <hr>
    div class="container">
    @section('footer')
    <h1>PIE DE PAGINA </h1>
    @show
</body>

</html>