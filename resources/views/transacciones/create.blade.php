@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Transacción</h1>

    <form action="{{ route('transacciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cuenta_id" class="form-label">Cuenta</label>
            <select name="cuenta_id" class="form-select" required>
                <option value="">Seleccione una cuenta</option>
                @foreach ($cuentas as $cuenta)
                    <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }} (Saldo: ${{ number_format($cuenta->saldo, 2) }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de transacción</label>
            <select name="tipo" class="form-select" required>
                <option value="ingreso">Ingreso</option>
                <option value="gasto">Gasto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción (opcional)</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
