<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - Página de Películas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #343a40;
        }
        .footer-custom {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        .header-image {
            width: 100%;
            height: auto;
            max-height: 300px; 
            object-fit: cover; 
        }
        .footer-image {
            width: 100%;
            height: auto;
            max-height: 150px; 
            object-fit: cover;
        }
    </style>
</head>

<body>
  
    <header class="bg-dark text-white text-center">
        @section('header')
            <div class="container-fluid p-0">
                <img src="{{ asset('header.jpg') }}" alt="Header" class="header-image">
                <h1 class="position-absolute top-50 start-50 translate-middle">Peliculas</h1>
            </div>
        @show
    </header>

 
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="/">Peliculas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/filmout/films">Películas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/actors/list">Actores</a>
                </li>
            </ul>
        </div>
    </nav>

 
    <div class="container mt-4">
        @yield('content')
    </div>

 
    <footer class="footer-custom text-center">
        @section('footer')
            <div class="container-fluid p-0">
                <img src="{{ asset('footer.jpg') }}" alt="Footer" class="footer-image">
                <p class="position-absolute bottom-0 start-50 translate-middle-x mb-3">© 2023 CineApp. Todos los derechos reservados.</p>
            </div>
        @show
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>