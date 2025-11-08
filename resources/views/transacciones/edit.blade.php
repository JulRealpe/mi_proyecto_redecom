@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center"> Editar Transacción</h2>

    <form action="{{ route('transacciones.update', $transaccion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Cuenta</label>
            <select name="cuenta_id" class="form-select" required>
                @foreach ($cuentas as $cuenta)
                    <option value="{{ $cuenta->id }}" {{ $cuenta->id == $transaccion->cuenta_id ? 'selected' : '' }}>
                        {{ $cuenta->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="ingreso" {{ $transaccion->tipo == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                <option value="gasto" {{ $transaccion->tipo == 'gasto' ? 'selected' : '' }}>Gasto</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Monto</label>
            <input type="number" name="monto" step="0.01" class="form-control" value="{{ $transaccion->monto }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ $transaccion->descripcion }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success"> Guardar Cambios</button>
            <a href="{{ route('transacciones.index') }}" class="btn btn-secondary"> Volver</a>
        </div>
    </form>
</div>
@endsection
