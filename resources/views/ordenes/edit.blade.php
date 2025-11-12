@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Orden de Servicio</h1>

    <form action="{{ route('ordenes.update', $orden->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Cliente -->
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" name="nombre_cliente" class="form-control @error('nombre_cliente') is-invalid @enderror" 
                value="{{ old('nombre_cliente', $orden->nombre_cliente) }}" required>
            @error('nombre_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" 
                value="{{ old('direccion', $orden->direccion) }}" required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="inicio" {{ old('estado', $orden->estado) == 'inicio' ? 'selected' : '' }}>Inicio</option>
                <option value="proceso" {{ old('estado', $orden->estado) == 'proceso' ? 'selected' : '' }}>Proceso</option>
                <option value="cerrar" {{ old('estado', $orden->estado) == 'cerrar' ? 'selected' : '' }}>Cerrar</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Observaciones -->
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observación</label>
            <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror">
                {{ old('observaciones', $orden->observaciones) }}
            </textarea>
            @error('observaciones')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Usuario asignado -->
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario Asignado</label>
            <select name="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" 
                        {{ old('usuario_id', $orden->usuario_id) == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
            @error('usuario_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Materiales -->
        <div class="mb-3">
            <label class="form-label">Materiales</label>
            @php
                $cantidades_actuales = $orden->materiales->pluck('pivot.cantidad', 'id')->toArray();
            @endphp
            
            @foreach($materiales as $material)
                @php
                    $cantidad_inicial = $cantidades_actuales[$material->id] ?? 0;
                @endphp
                <div class="mb-2">
                    <label class="d-inline-block me-3">{{ $material->nombre }} (Cantidad)</label>
                    <input type="number" 
                           name="cantidades_materiales[{{ $material->id }}]" 
                           min="0"
                           class="form-control d-inline w-auto"
                           value="{{ old('cantidades_materiales.' . $material->id, $cantidad_inicial) }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
