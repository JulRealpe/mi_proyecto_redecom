@extends('layouts.app')

@section('title', 'Informes Generados')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Listado de Órdenes para Generación de Informes</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">A continuación se muestran todas las órdenes de servicio. Utiliza las acciones para generar los informes correspondientes (PDF/Excel).</p>
            
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Orden</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Usamos @forelse para iterar sobre $ordenes y manejar el caso vacío (@empty) --}}
                    @forelse($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->id }}</td>
                        <td>{{ $orden->nombre_cliente }}</td>
                        <td>{{ $orden->direccion }}</td>
                        <td>
                            @if($orden->estado == 'inicio')
                                <span class="badge bg-info">Inicio</span>
                            @elseif($orden->estado == 'proceso')
                                <span class="badge bg-warning">Proceso</span>
                            @elseif($orden->estado == 'cerrar')
                                <span class="badge bg-success">Cerrar</span>
                            @endif
                        </td>
                        <td>{{ $orden->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{-- Los enlaces usan $orden->id --}}
                            <a href="{{ route('informes.pdf', $orden->id) }}" class="btn btn-sm btn-danger me-2" title="Generar PDF">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('ordenes.excel', $orden->id) }}" class="btn btn-sm btn-success" title="Generar Excel (CSV)">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Excel
                            </a>
                        </td>
                    </tr>
                    {{-- Bloque @empty para cuando $ordenes está vacío --}}
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No se encontraron Órdenes de Servicio para generar informes.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection