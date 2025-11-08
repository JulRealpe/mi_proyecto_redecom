@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center">
            <h3> Detalle de Transacción</h3>
        </div>

        <div class="card-body p-4">
            <p><strong>ID:</strong> {{ $transaccion->id }}</p>
            <p><strong>Cuenta:</strong> {{ $transaccion->cuenta?->nombre ?? 'Sin cuenta' }}</p>
            <p>
                <strong>Tipo:</strong>
                @if($transaccion->tipo === 'ingreso')
                    <span class="badge bg-success">Ingreso</span>
                @else
                    <span class="badge bg-danger">Gasto</span>
                @endif
            </p>
            <p><strong>Monto:</strong> ${{ number_format($transaccion->monto, 2) }}</p>
            <p><strong>Descripción:</strong> {{ $transaccion->descripcion ?: 'Sin descripción' }}</p>
            <p><strong>Fecha:</strong> {{ $transaccion->created_at->format('d/m/Y H:i') }}</p>

            <div class="mt-4 text-center">
                <a href="{{ route('transacciones.edit', $transaccion->id) }}" class="btn btn-warning">✏️ Editar</a>
                <a href="{{ route('transacciones.index') }}" class="btn btn-secondary"> Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
