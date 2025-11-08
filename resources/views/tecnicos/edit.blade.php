@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Editar Técnico</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Revisa los campos.
        </div>
    @endif

    <form action="{{ route('tecnicos.update', $tecnico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $tecnico->nombre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="activo" {{ $tecnico->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $tecnico->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Técnico</button>
        <a href="{{ route('tecnicos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
