<h3>Informe de Orden #{{ $orden->id }}</h3>
<p>Cliente: {{ $orden->nombre_cliente }}</p>
<p>Estado: {{ $orden->estado }}</p>
<p>Técnicos:</p>
<ul>
    @foreach($orden->tecnicos as $tecnico)
        <li>{{ $tecnico->nombre }}</li>
    @endforeach
</ul>
<p>Materiales:</p>
<ul>
    @foreach($orden->materiales as $material)
        <li>{{ $material->nombre }} - Cantidad: {{ $material->pivot->cantidad }}</li>
    @endforeach
</ul>
