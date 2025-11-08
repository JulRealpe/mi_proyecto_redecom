@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Orden de Servicio</h2>

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Revisa los campos obligatorios.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('ordenes.update', $orden->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" value="{{ old('nombre_cliente', $orden->nombre_cliente) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $orden->direccion) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $orden->fecha_inicio) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Fecha de Finalización</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $orden->fecha_fin) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones', $orden->observaciones) }}</textarea>
        </div>

        
        <div class="mb-4">
            <label class="form-label">Seleccionar Técnicos</label>
            <select name="tecnicos[]" class="form-select" multiple>
                @foreach ($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}" 
                        {{ in_array($tecnico->id, $orden->tecnicos->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $tecnico->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar varios.</small>
        </div>

        
        <div class="mb-4">
            <h5>Materiales</h5>

            @php
                $agrupados = $materiales->groupBy('categoria_id');
                $materialesOrden = $orden->materiales->pluck('pivot.cantidad', 'id')->toArray();
            @endphp

            @foreach ($agrupados as $categoriaId => $materialesCategoria)
                @php
                    $categoriaNombre = $materialesCategoria->first()->categoria->nombre ?? 'Sin categoría';
                @endphp

                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        {{ $categoriaNombre }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($materialesCategoria as $material)
                                @php
                                    $cantidadActual = old("materiales.{$material->id}.cantidad", $materialesOrden[$material->id] ?? 0);
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">{{ $material->nombre }}</label>
                                    <input type="number" name="materiales[{{ $material->id }}][cantidad]"
                                           class="form-control"
                                           value="{{ $cantidadActual }}"
                                           min="0">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary px-4">Actualizar Orden</button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
