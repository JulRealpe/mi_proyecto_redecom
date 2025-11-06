@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cuentas</h1>

    <a href="{{ route('cuentas.create') }}" class="btn btn-primary mb-3">+ Nueva Cuenta</a>
    <a href="{{ route('transacciones.create') }}" class="btn btn-success mb-3">Registrar Transacción</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->nombre }}</td>
                    <td>${{ number_format($cuenta->saldo, 2) }}</td>
                    <td>
                        <a href="{{ route('cuentas.edit', $cuenta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cuenta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
