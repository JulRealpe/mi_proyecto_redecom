@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Nueva Categoría</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups...</strong> Hay algunos errores en el formulario:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Categoría</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="">-- Selecciona un tipo --</option>
                <option value="ingreso" {{ old('tipo') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                <option value="gasto" {{ old('tipo') == 'gasto' ? 'selected' : '' }}>Gasto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">⬅ Volver</a>
            <button type="submit" class="btn btn-primary">Guardar Categoría</button>
        </div>
    </form>
</div>
@endsection
