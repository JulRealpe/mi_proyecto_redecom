@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Registrar Material</h1>

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

    <form action="{{ route('materiales.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nombre">Nombre del material</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre') }}" placeholder="Ejemplo: Tornillos, Pintura, Cables...">
        </div>

        <div class="form-group mb-3">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control"
                   value="{{ old('cantidad') }}" placeholder="Ejemplo: 10">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <div class="form-group mb-3">
    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="form-control">
        <option value="activo" selected>Activo</option>
        <option value="inactivo">Inactivo</option>
    </select>
</div>

        <a href="{{ route('materiales.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
