@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"> Lista de Transacciones</h4>
            <a href="{{ route('transacciones.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Nueva Transacción
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Cuenta</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transacciones as $transaccion)
                            <tr>
                                <td>{{ $transaccion->id }}</td>
                                <td>{{ $transaccion->cuenta->nombre ?? 'Sin cuenta' }}</td>
                                <td>
                                    @if ($transaccion->tipo === 'ingreso')
                                        <span class="badge bg-success">Ingreso</span>
                                    @else
                                        <span class="badge bg-danger">Gasto</span>
                                    @endif
                                </td>
                                <td>${{ number_format($transaccion->monto, 2) }}</td>
                                <td>{{ $transaccion->descripcion ?? '—' }}</td>
                                <td>{{ $transaccion->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('transacciones.edit', $transaccion->id) }}" 
                                           class="btn btn-sm btn-warning d-flex align-items-center">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>

                                        <form action="{{ route('transacciones.destroy', $transaccion->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('¿Seguro que deseas eliminar esta transacción?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                <i class="bi bi-trash3 me-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">No hay transacciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
