@extends('layouts.app')

@section('title', 'Detalle de Asistencia')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detalles de Asistencia</h5>
        </div>
        <div class="card-body">
            <p><strong>Técnico:</strong> {{ $asistencia->usuario->nombre ?? 'Eliminado' }}</p>
            <p><strong>Fecha y Hora:</strong> {{ $asistencia->fecha_hora ? \Carbon\Carbon::parse($asistencia->fecha_hora)->format('Y-m-d H:i:s') : 'N/A' }}</p>
            <p><strong>Observaciones:</strong> {{ $asistencia->observacion ?? 'Sin observaciones' }}</p>

            @if($asistencia->ordenes->isNotEmpty())
                <p><strong>Órdenes Asociadas:</strong></p>
                <ul>
                    @foreach ($asistencia->ordenes as $orden)
                        <li>#{{ $orden->id }} - {{ $orden->nombre_cliente ?? 'Sin nombre' }}</li>
                    @endforeach
                </ul>
            @else
                <p><strong>Órdenes Asociadas:</strong> Ninguna</p>
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
