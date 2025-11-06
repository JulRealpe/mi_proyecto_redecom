<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gasto Financiero') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8fafc;
            font-family: "Segoe UI", Roboto, sans-serif;
        }

        .navbar {
            background-color: #1f2937; /* gris oscuro elegante */
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: #e5e7eb !important;
            transition: 0.3s;
            font-weight: 500;
        }


        .nav-link.text-danger:hover {
            color: #ef4444 !important; 
        }

        main {
            min-height: 80vh;
        }

        footer {
            background-color: #1f2937;
            color: #e5e7eb;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Gestor Financiero</a>
            <ul class="navbar-nav ms-auto d-flex flex-row gap-3">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                         Salir
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} Gasto Financiero — Controla tus finanzas con facilidad.</p>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
