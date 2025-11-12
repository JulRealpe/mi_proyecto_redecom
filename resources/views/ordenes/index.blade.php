@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Órdenes de Servicio</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-3">Crear Orden</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Técnicos</th>
                <th>Materiales</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenes as $orden)
                <tr>
                    <td>{{ $orden->id }}</td>
                    <td>{{ $orden->nombre_cliente }}</td>
                    <td>
                        @if($orden->estado == 'inicio')
                            <span class="badge bg-primary">Inicio</span>
                        @elseif($orden->estado == 'proceso')
                            <span class="badge bg-warning">Proceso</span>
                        @elseif($orden->estado == 'cerrar')
                            <span class="badge bg-success">Cerrar</span>
                        @else
                            {{ ucfirst($orden->estado) }}
                        @endif
                    </td>
                    <td>{{ $orden->observaciones ?? '-' }}</td>
                    <td>
                        <ul>
                            @foreach($orden->tecnicos as $tecnico)
                                <li>{{ $tecnico->nombre }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($orden->materiales as $material)
                                <li>{{ $material->nombre }} - Cantidad: {{ $material->pivot->cantidad }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('ordenes.edit', $orden->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar esta orden?')">Eliminar</button>
                        </form>
                        
                        {{-- SE ELIMINARON LOS BOTONES DE EXCEL Y PDF DE ESTA VISTA --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection