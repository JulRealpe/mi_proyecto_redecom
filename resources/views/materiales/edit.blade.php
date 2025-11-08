@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Editar Material</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Revisa los campos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materiales.update', $material) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre">Nombre del material</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre', $material->nombre) }}">
        </div>

        <div class="form-group mb-3">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control"
                   value="{{ old('cantidad', $material->cantidad) }}">
        </div>
        <div class="form-group mb-3">
    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="form-control">
        <option value="activo" {{ $material->estado == 'activo' ? 'selected' : '' }}>Activo</option>
        <option value="inactivo" {{ $material->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('materiales.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
