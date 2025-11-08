@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Registrar Nueva Orden de Servicio</h2>

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Revisa los campos marcados.
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('ordenes.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre_cliente" class="form-label fw-semibold">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" value="{{ old('nombre_cliente') }}" required>
            </div>
            <div class="col-md-6">
                <label for="direccion" class="form-label fw-semibold">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_inicio" class="form-label fw-semibold">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_fin" class="form-label fw-semibold">Fecha de Finalización</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
            </div>
        </div>

        
        <div class="mb-3">
            <label class="form-label fw-semibold">Técnicos Asignados</label>
            <select name="tecnicos[]" class="form-select" multiple>
                @foreach ($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                @endforeach
            </select>
            <small class="text-muted">Mantén presionada la tecla CTRL (o CMD en Mac) para seleccionar varios técnicos.</small>
        </div>

        
        <div class="mb-3">
            <label class="form-label fw-semibold">Materiales Utilizados</label>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Material</th>
                            <th style="width: 120px;">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiales as $material)
                            <tr>
                                <td>{{ $material->nombre }}</td>
                                <td class="text-center">
                                    <input type="number" name="materiales[{{ $material->id }}][cantidad]" 
                                           class="form-control text-center" min="0" value="0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

       
        <div class="mb-3">
            <label for="observaciones" class="form-label fw-semibold">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
        </div>

        
        <div class="d-flex justify-content-between">
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">← Volver</a>
            <button type="submit" class="btn btn-success fw-semibold"> Guardar Orden</button>
        </div>
    </form>
</div>
@endsection
