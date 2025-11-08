@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Órdenes de Servicio</h2>
        <a href="{{ route('ordenes.create') }}" class="btn btn-success">
            + Nueva Orden
        </a>
    </div>

    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
    @if ($ordenes->isEmpty())
        <div class="alert alert-info text-center">
            No hay órdenes registradas aún.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Fechas</th>
                        <th>Técnicos</th>
                        <th>Materiales</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes as $orden)
                        <tr>
                            <td class="text-center">{{ $orden->id }}</td>
                            <td>{{ $orden->nombre_cliente }}</td>
                            <td>{{ $orden->direccion }}</td>
                            <td class="text-center">
                                <small>
                                    <strong>Inicio:</strong> {{ $orden->fecha_inicio }}<br>
                                    <strong>Fin:</strong> {{ $orden->fecha_fin ?? '—' }}
                                </small>
                            </td>

                            
                            <td>
                                @if ($orden->tecnicos->isEmpty())
                                    <span class="text-muted">Sin técnicos</span>
                                @else
                                    <ul class="mb-0">
                                        @foreach ($orden->tecnicos as $tec)
                                            <li>{{ $tec->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>

                           
                            <td>
                                @if ($orden->materiales->isEmpty())
                                    <span class="text-muted">Sin materiales</span>
                                @else
                                    <ul class="mb-0">
                                        @foreach ($orden->materiales as $mat)
                                            <li>
                                                {{ $mat->nombre }}
                                                <span class="badge bg-secondary">
                                                    x{{ $mat->pivot->cantidad }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>

                            <td>{{ $orden->observaciones ?? '—' }}</td>

                            
                            <td class="text-center">
                                <a href="{{ route('ordenes.edit', $orden->id) }}" class="btn btn-sm btn-primary">
                                     Editar
                                </a>
                                <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta orden?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
