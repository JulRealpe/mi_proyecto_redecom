@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Cuenta</h1>

    <form action="{{ route('cuentas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la cuenta</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="saldo" class="form-label">Saldo inicial</label>
            <input type="number" name="saldo" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
