@extends('layouts.app')

@section('title', 'Informe de Asistencia')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container">
    <h2 class="text-center mb-4">📅 Informe de Asistencia de Técnicos</h2>

    <!-- 🔹 Filtros -->
    <form method="GET" action="{{ route('asistencias.index') }}" class="row mb-4">
        <div class="col-md-4">
            <label class="form-label fw-bold">Filtrar por Fecha:</label>
            <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Filtrar por Técnico:</label>
            <select name="usuario_id" class="form-select">
                <option value="">Todos</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ request('usuario_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-funnel"></i> Aplicar Filtros
            </button>
        </div>
    </form>

    <!-- 🔹 Exportaciones -->
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('asistencias.exportPdf') }}" class="btn btn-danger me-2">
            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
        </a>
        <a href="{{ route('asistencias.exportExcel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Exportar Excel
        </a>
    </div>

    <!-- 🔹 Tabla -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            @if ($asistencias->isEmpty())
                <div class="alert alert-warning text-center">
                    No se encontraron registros para los filtros seleccionados.
                </div>
            @else
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Técnico</th>
                            <th>Tipo de Registro</th>
                            <th>Fecha y Hora</th>
                            <th>Órdenes Asociadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            <tr>
                                <td>{{ $asistencia->usuario->nombre ?? 'Eliminado' }}</td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $asistencia->tipo_registro === 'entrada' ? 'success' :
                                        ($asistencia->tipo_registro === 'salida' ? 'danger' :
                                        ($asistencia->tipo_registro === 'pausa' ? 'warning text-dark' : 'info text-dark')) 
                                    }}">
                                        {{ ucfirst($asistencia->tipo_registro) }}
                                    </span>
                                </td>
                                <td>{{ $asistencia->fecha_hora ? \Carbon\Carbon::parse($asistencia->fecha_hora)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                <td>
                                    @forelse ($asistencia->ordenes as $orden)
                                        <span class="badge bg-secondary">
                                            #{{ $orden->id }} - {{ Str::limit($orden->nombre_cliente ?? 'Sin nombre', 20) }}
                                        </span>
                                    @empty
                                        <span class="text-muted">Ninguna</span>
                                    @endforelse
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
