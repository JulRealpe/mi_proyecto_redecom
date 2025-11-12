@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Orden de Servicio</h1>

    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" name="nombre_cliente" class="form-control" value="{{ old('nombre_cliente') }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="inicio" {{ old('estado') == 'inicio' ? 'selected' : '' }}>Inicio</option>
                <option value="proceso" {{ old('estado') == 'proceso' ? 'selected' : '' }}>Proceso</option>
                <option value="cerrar" {{ old('estado') == 'cerrar' ? 'selected' : '' }}>Cerrar</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observación</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Técnicos</label>
            @foreach($tecnicos as $tecnico)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tecnicos[]" value="{{ $tecnico->id }}" {{ in_array($tecnico->id, old('tecnicos', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $tecnico->nombre }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="form-label">Materiales</label>
            @foreach($materiales as $material)
                <div class="mb-2">
                    <label class="d-inline-block me-3">
                        {{ $material->nombre }} (Cantidad)
                    </label>
                    <input type="number" 
                           name="cantidades_materiales[{{ $material->id }}]" 
                           value="{{ old('cantidades_materiales.' . $material->id, 0) }}" 
                           min="0" 
                           class="form-control d-inline w-auto">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection