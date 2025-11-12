<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REDECOM - Sistema de Gestión</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            background-color: #3765a8;
            color: white;
            padding: 20px 15px;
        }
        .sidebar img {
            width: 70%;
            margin: 0 auto 20px;
            display: block;
        }
        .sidebar h5 {
            text-align: center;
            margin-bottom: 15px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .content {
            margin-left: 250px;
            padding: 25px;
        }
        .navbar {
            background-color: white;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        main {
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <img src="https://redecom.com.co/wp-content/uploads/2022/12/Proyecto-nuevo-7.png" alt="Logo REDECOM">
        <h5>REDECOM</h5>
        <hr>

        <a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Inicio</a>
        
        <!-- Usuarios / Técnicos -->
        <a href="{{ route('usuarios.index') }}"><i class="bi bi-people"></i> Usuarios / Técnicos</a>

        <!-- Asistencias -->
        <a href="{{ route('asistencias.create') }}"><i class="fas fa-clock"></i> Registrar Asistencia</a>
        <a href="{{ route('asistencias.index') }}"><i class="fas fa-calendar-check"></i> Informe Asistencia</a>

        <!-- Materiales -->
        <a href="{{ route('materiales.index') }}"><i class="bi bi-box-seam"></i> Materiales</a>
        <a href="{{ route('transacciones.index') }}"><i class="bi bi-cash-stack"></i> Transacciones</a>
        <a href="{{ route('cuentas.index') }}"><i class="bi bi-wallet2"></i> Cuentas</a>
        <a href="{{ route('ordenes.index') }}"><i class="bi bi-clipboard-check"></i> Órdenes</a>
        <a href="{{ route('informes.index') }}"><i class="bi bi-file-earmark-text"></i> Informes</a>

        <hr>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light w-100 mt-2" type="submit">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </button>
        </form>
    </div>

    <div class="content">
        <div class="navbar">
            <h4 class="mb-0">@yield('title', 'Panel de Control')</h4>
            <span class="text-muted">
                Usuario: {{ Auth::user()->nombre ?? 'Invitado' }}
            </span>
        </div>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
