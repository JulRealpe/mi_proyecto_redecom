@extends('layouts.app')

@section('title', 'Registrar Nuevo Usuario')

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Registrar Nuevo Usuario</h4>
        </div>

        <div class="card-body px-5 py-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-semibold">Nombre completo</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            id="nombre" 
                            class="form-control" 
                            placeholder="Ingrese el nombre del usuario" 
                            required 
                            value="{{ old('nombre') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="usuario@redecom.com" 
                            required 
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="rol" class="form-label fw-semibold">Rol del usuario</label>
                        <select name="rol" id="rol" class="form-select" required>
                            <option value="">Seleccione un rol</option>
                            <option value="administracion" {{ old('rol') == 'administracion' ? 'selected' : '' }}>Administración</option>
                            <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="tecnico" {{ old('rol') == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control" 
                            placeholder="Mínimo 8 caracteres" 
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar contraseña</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="form-control" 
                            placeholder="Repita la contraseña" 
                            required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-person-plus"></i> Registrar Usuario
                    </button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary px-4 ms-2">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
