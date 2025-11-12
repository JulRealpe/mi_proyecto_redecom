@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Editar Usuario</h4>
        </div>

        <div class="card-body px-5 py-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong> Revisa los campos marcados.
                </div>
            @endif

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="nombre" class="form-control" 
                               value="{{ old('nombre', $usuario->nombre) }}" required>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email', $usuario->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Contraseña (déjala en blanco si no deseas cambiarla)
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="********">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Rol</label>
                        <select name="rol" class="form-select" required>
                            <option value="administracion" {{ old('rol', $usuario->rol) == 'administracion' ? 'selected' : '' }}>Administración</option>
                            <option value="supervisor" {{ old('rol', $usuario->rol) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="tecnico" {{ old('rol', $usuario->rol) == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                        @error('rol')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">
                        Actualizar Usuario
                    </button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary ms-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
