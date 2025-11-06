@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Gestor Financiero</h1>
        <p class="text-muted">Administra tus categorías, cuentas y transacciones fácilmente</p>
    </div>

    <!-- Tarjetas de acceso -->
    <div class="row justify-content-center g-4">
        <!-- Categorías -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center hover-card">
                <div class="card-body">
                    <h4 class="fw-bold text-primary">Categorías</h4>
                    <p class="text-muted">Organiza tus gastos e ingresos en diferentes categorías.</p>
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-primary w-100">Ir a Categorías</a>
                </div>
            </div>
        </div>

        <!-- Cuentas -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center hover-card">
                <div class="card-body">
                    <h4 class="fw-bold text-success">Cuentas</h4>
                    <p class="text-muted">Administra tus cuentas y visualiza tus saldos.</p>
                    <a href="{{ route('cuentas.index') }}" class="btn btn-outline-success w-100">Ir a Cuentas</a>
                </div>
            </div>
        </div>

        <!-- Transacciones -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center hover-card">
                <div class="card-body">
                    <h4 class="fw-bold text-warning">Transacciones</h4>
                    <p class="text-muted">Registra tus ingresos y gastos de forma rápida.</p>
                    <a href="{{ route('transacciones.index') }}" class="btn btn-outline-warning w-100">Ir a Transacciones</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
