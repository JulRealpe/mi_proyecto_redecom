<h3>Informe de Orden #{{ $orden->id }}</h3>
<p>Cliente: {{ $orden->nombre_cliente }}</p>
<p>Estado: {{ $orden->estado }}</p>
<p>Usuario:</p>
<ul>
    @foreach($orden->usuario as $usuario)
        <li>{{ $usuario->nombre }}</li>
    @endforeach
</ul>
<p>Materiales:</p>
<ul>
    @foreach($orden->materiales as $material)
        <li>{{ $material->nombre }} - Cantidad: {{ $material->pivot->cantidad }}</li>
    @endforeach
</ul>
