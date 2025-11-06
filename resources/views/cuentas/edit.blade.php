@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cuenta</h1>

    <form action="{{ route('cuentas.update', $cuenta->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ $cuenta->nombre }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="saldo" class="form-label">Saldo</label>
            <input type="number" name="saldo" value="{{ $cuenta->saldo }}" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
