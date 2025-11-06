@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bienvenido al Panel de Control</h1>

    <div class="row">
        <!-- Tarjeta Categorías -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Categorías</h5>
                    <a href="{{ route('categorias.index') }}" class="btn btn-primary">Ver categorías</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta Cuentas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Cuentas</h5>
                    <a href="{{ route('cuentas.index') }}" class="btn btn-success">Ver cuentas</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta Transacciones -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Transacciones</h5>
                    <a href="{{ route('transacciones.index') }}" class="btn btn-warning text-white">Ver transacciones</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
