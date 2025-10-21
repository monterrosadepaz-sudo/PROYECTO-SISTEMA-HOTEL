<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">Hotel MEGATEC</a>
            <div>
                <a href="/" class="btn btn-outline-light btn-sm">Salir</a>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-4">
        @yield('contenido')
    </div>
</body>
</html>