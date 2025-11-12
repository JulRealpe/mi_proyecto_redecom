@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Materiales</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('materiales.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Material</a>

    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $material->cantidad }}</td>
                    <td>
                        <span class="badge {{ $material->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($material->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('materiales.show', $material->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('materiales.edit', $material->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('materiales.toggle', $material->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $material->estado == 'activo' ? 'btn-secondary' : 'btn-success' }}">
                                {{ $material->estado == 'activo' ? 'Inactivar' : 'Activar' }}
                            </button>
                        </form>

                        <form action="{{ route('materiales.destroy', $material->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar este material?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay materiales registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
