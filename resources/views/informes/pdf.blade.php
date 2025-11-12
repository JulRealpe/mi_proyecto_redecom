<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Orden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<h2>Informe de Orden de Servicio</h2>

<p><strong>Cliente:</strong> {{ $orden->nombre_cliente }}</p>
<p><strong>Dirección:</strong> {{ $orden->direccion }}</p>
<p><strong>Fecha Inicio:</strong> {{ $orden->fecha_inicio ?? 'No definida' }}</p>
<p><strong>Fecha Fin:</strong> {{ $orden->fecha_fin ?? 'No definida' }}</p>
<p><strong>Observaciones:</strong> {{ $orden->observaciones ?? 'Sin observaciones' }}</p>
<p><strong>Estado:</strong> {{ $orden->estado }}</p>

<p class="section-title">Técnico Asignado</p>
<p>
    {{ $orden->usuario->nombre ?? 'Sin técnico asignado' }}<br>
    Email: {{ $orden->usuario->email ?? 'Sin email' }}
</p>

@if($orden->materiales && $orden->materiales->count() > 0)
    <p class="section-title">Materiales Asociados</p>
    <table>
        <thead>
            <tr>
                <th>Nombre Material</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->materiales as $material)
                <tr>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $material->pivot->cantidad ?? '0' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay materiales asociados a esta orden.</p>
@endif

</body>
</html>
