@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Orden de Servicio</h1>

    <!-- Mensaje de error general -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Atención:</strong> Por favor, corrige los errores del formulario para continuar.
        </div>
    @endif

    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf

        <!-- Cliente -->
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" 
                   id="nombre_cliente"
                   name="nombre_cliente" 
                   class="form-control @error('nombre_cliente') is-invalid @enderror" 
                   value="{{ old('nombre_cliente') }}" 
                   placeholder="Nombre del cliente"
                   required>
            @error('nombre_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" 
                   id="direccion"
                   name="direccion" 
                   class="form-control @error('direccion') is-invalid @enderror" 
                   value="{{ old('direccion') }}" 
                   placeholder="Ejemplo: Calle 10 #23-45"
                   required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Asignar Técnico / Usuario -->
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Asignar Técnico / Usuario</label>
            <select id="usuario_id" 
                    name="usuario_id" 
                    class="form-select @error('usuario_id') is-invalid @enderror" 
                    required>
                <option value="">-- Selecciona un técnico --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
            @error('usuario_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" 
                    name="estado" 
                    class="form-select @error('estado') is-invalid @enderror" 
                    required>
                <option value="inicio" {{ old('estado') == 'inicio' ? 'selected' : '' }}>Inicio</option>
                <option value="proceso" {{ old('estado') == 'proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="cerrar" {{ old('estado') == 'cerrar' ? 'selected' : '' }}>Cerrada</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Observaciones -->
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" 
                      name="observaciones" 
                      rows="3"
                      class="form-control @error('observaciones') is-invalid @enderror"
                      placeholder="Notas o comentarios sobre la orden...">{{ old('observaciones') }}</textarea>
            @error('observaciones')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Materiales -->
        <div class="mb-3">
            <label class="form-label">Materiales</label>
            <div class="border rounded-3 p-3 bg-light">
                @if(isset($materiales) && $materiales->count() > 0)
                    @foreach($materiales as $material)
                        <div class="mb-2 border-bottom pb-2">
                            <label class="fw-bold d-block">
                                {{ $material->nombre }}
                                <small class="text-muted">
                                    (Disponible: {{ $material->cantidad ?? 0 }})
                                </small>
                            </label>
                            <input type="number"
                                   name="cantidades_materiales[{{ $material->id }}]"
                                   value="{{ old('cantidades_materiales.' . $material->id, 0) }}"
                                   min="0"
                                   max="{{ $material->cantidad ?? 0 }}"
                                   class="form-control w-25 d-inline">
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center mb-0">
                        📦 No hay materiales disponibles en el inventario actualmente.
                    </p>
                @endif
            </div>
        </div>

        <!-- Botón -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary px-4">
                Guardar Orden
            </button>
        </div>
    </form>
</div>
@endsection
