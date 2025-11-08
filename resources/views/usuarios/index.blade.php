<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios | Redecom Ingeniería SAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Redecom Ingeniería SAS</a>
        <a href="{{ route('usuarios.create') }}" class="btn btn-light btn-sm"> Nuevo Usuario</a>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="text-primary mb-3 text-center">Gestión de Usuarios</h3>

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>{{ ucfirst($usuario->rol) }}</td>
                            <td>
                                <span class="badge {{ $usuario->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($usuario->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">✏️ Editar</a>

                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')"> Eliminar</button>
                                </form>

                                
                                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="{{ $usuario->estado == 'activo' ? 'inactivo' : 'activo' }}">
                                    <button type="submit" class="btn btn-sm {{ $usuario->estado == 'activo' ? 'btn-secondary' : 'btn-success' }}">
                                        {{ $usuario->estado == 'activo' ? 'Inactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
