<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="menu-lateral">
        <h2>Menú Lateral</h2>
        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>

        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>

        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>

        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>

        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>
    </div>

    <div style="flex: 1; display: flex; flex-direction: column;">
        <header>
            <h1>Mi Aplicación</h1>
        </header>

        <div class="menu-superior">
            <p>Menú Superior</p>
        </div>

        <div class="contenido">
            @yield('contenido')
        </div>

        <footer>
            <p>Todos los derechos reservados - 2024</p>
        </footer>
    </div>
</body>
</html>
