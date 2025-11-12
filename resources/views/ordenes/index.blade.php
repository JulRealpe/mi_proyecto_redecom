@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Órdenes de Servicio</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-3">Crear Orden</a>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th>ID</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Usuario asignado</th>
                <th>Materiales</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ordenes as $orden)
                <tr>
                    <td>{{ $orden->id }}</td>
                    <td>{{ $orden->nombre_cliente }}</td>
                    <td class="text-center">
                        @if($orden->estado == 'inicio')
                            <span class="badge bg-primary">Inicio</span>
                        @elseif($orden->estado == 'proceso')
                            <span class="badge bg-warning text-dark">Proceso</span>
                        @elseif($orden->estado == 'cerrar')
                            <span class="badge bg-success">Cerrado</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($orden->estado) }}</span>
                        @endif
                    </td>
                    <td>{{ $orden->observaciones ?? '—' }}</td>

                    {{-- Usuario asignado (reemplaza Técnicos) --}}
                    <td>
                        @if($orden->usuario)
                            {{ $orden->usuario->nombre }}
                        @else
                            <span class="text-muted">No asignado</span>
                        @endif
                    </td>

                    {{-- Materiales --}}
                    <td>
                        @if(isset($orden->materiales) && $orden->materiales->count() > 0)
                            <ul class="mb-0">
                                @foreach($orden->materiales as $material)
                                    <li>{{ $material->nombre }} ({{ $material->pivot->cantidad }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Sin materiales</span>
                        @endif
                    </td>

                    {{-- Acciones --}}
                    <td class="text-center">
                        <a href="{{ route('ordenes.edit', $orden->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar esta orden?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay órdenes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
