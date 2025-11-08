<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <!-- Nombre del sistema -->
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">Mi Sistema</a>

    <!-- Botón hamburguesa para móvil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
      aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido del menú -->
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ms-auto">

        <!-- Menú desplegable Gestión -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Gestión
          </a>
          <ul class="dropdown-menu dropdown-menu-end bg-dark border-0 shadow">
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('categorias.index') }}">
                Categorías
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('cuentas.index') }}">
                Cuentas
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('transacciones.index') }}">
                Transacciones
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('usuarios.index') }}">
                Usuarios
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('materiales.index') }}">
                Materiales
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('tecnicos.index') }}">
                Técnicos
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white bg-dark-hover" href="{{ route('ordenes.index') }}">
                Órdenes de Servicio
              </a>
            </li>
          </ul>
        </li>

        <!-- Botón para cerrar sesión -->
        <li class="nav-item ms-3">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm px-3">Salir</button>
          </form>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- Estilo adicional para hover -->
<style>
  .dropdown-menu a.dropdown-item:hover {
    background-color: #495057 !important;
    color: #fff !important;
  }
</style>
