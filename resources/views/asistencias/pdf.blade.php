<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia - {{ $fecha }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0d6efd; }
        table { width: 100%; border-collapse: collapse; font-size: 0.9em; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f8f9fa; text-transform: uppercase; }
        .badge { display: inline-block; padding: 3px 6px; border-radius: 3px; font-size: 0.8em; color: white; }
        .entrada { background: #198754; }
        .salida { background: #dc3545; }
        .pausa { background: #ffc107; color: #000; }
        .retorno { background: #0dcaf0; color: #000; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte Diario de Asistencia</h2>
        <p>Fecha: {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
    </div>

    @if ($registros->isEmpty())
        <p>No se encontraron registros para esta fecha.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Técnico</th>
                    <th>Tipo</th>
                    <th>Hora</th>
                    <th>Órdenes Asociadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->usuario->nombre ?? 'Eliminado' }}</td>
                        <td><span class="badge {{ $registro->tipo_registro }}">{{ ucfirst($registro->tipo_registro) }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($registro->fecha_hora)->format('H:i:s') }}</td>
                        <td>
                            @forelse ($registro->ordenes as $orden)
                                #{{ $orden->id }} - {{ $orden->nombre_cliente ?? 'Sin nombre' }}<br>
                            @empty
                                Ninguna
                            @endforelse
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
