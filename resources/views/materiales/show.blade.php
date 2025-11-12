@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Detalles del Material</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $material->nombre }}</h5>
            <p class="card-text"><strong>Cantidad:</strong> {{ $material->cantidad }}</p>
            <p class="card-text"><strong>Estado:</strong>
                <span class="badge {{ $material->estado === 'activo' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($material->estado) }}
                </span>
            </p>
            @if($material->descripcion)
                <p class="card-text"><strong>Descripción:</strong> {{ $material->descripcion }}</p>
            @endif

            <a href="{{ route('materiales.index') }}" class="btn btn-primary mt-2">Volver a la lista</a>
        </div>
    </div>
</div>
@endsection
