@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Lista de Técnicos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tecnicos.create') }}" class="btn btn-success mb-3">Registrar Técnico</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tecnicos as $tecnico)
                <tr>
                    <td>{{ $tecnico->id }}</td>
                    <td>{{ $tecnico->nombre }}</td>
                    <td>
                        <span class="badge {{ $tecnico->estado == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($tecnico->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tecnicos.edit', $tecnico->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('tecnicos.destroy', $tecnico->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este técnico?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay técnicos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
