@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"> Detalles de la Categoría</h4>
            <a href="{{ route('categorias.index') }}" class="btn btn-light btn-sm"> Volver</a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong>
                <p class="form-control-plaintext">{{ $categoria->id }}</p>
            </div>

            <div class="mb-3">
                <strong>Nombre:</strong>
                <p class="form-control-plaintext">{{ $categoria->nombre }}</p>
            </div>

            <div class="mb-3">
                <strong>Tipo:</strong>
                <p>
                    <span class="badge {{ $categoria->tipo === 'ingreso' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($categoria->tipo) }}
                    </span>
                </p>
            </div>

            <div class="mb-3">
                <strong>Descripción:</strong>
                <p class="form-control-plaintext">{{ $categoria->descripcion ?? '—' }}</p>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">
                 Editar
            </a>
            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta categoría?')">
                     Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
