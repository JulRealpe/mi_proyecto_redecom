@extends('layouts.app')

@section('title', 'Registrar Asistencia')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Registro de Asistencia</h2>
                    <p class="mb-0">Marca tu hora de entrada, salida o pausa</p>
                </div>

                <div class="card-body p-4">
                    {{-- Mensaje de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Errores de validación --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form method="POST" action="{{ route('asistencias.store') }}">
                        @csrf

                        {{-- Técnico (usuario activo) --}}
                        <div class="mb-4">
                            <label for="usuario_id" class="form-label fw-bold">Técnico a Registrar</label>
                            <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Selecciona un técnico</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuario_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipo de registro --}}
                        <div class="mb-4">
                            <label for="tipo_registro" class="form-label fw-bold">Tipo de Registro</label>
                            <select name="tipo_registro" id="tipo_registro" class="form-select @error('tipo_registro') is-invalid @enderror" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="entrada" {{ old('tipo_registro') == 'entrada' ? 'selected' : '' }}>Entrada (Inicio de Jornada)</option>
                                <option value="salida" {{ old('tipo_registro') == 'salida' ? 'selected' : '' }}>Salida (Fin de Jornada)</option>
                                <option value="pausa" {{ old('tipo_registro') == 'pausa' ? 'selected' : '' }}>Pausa / Almuerzo</option>
                                <option value="retorno" {{ old('tipo_registro') == 'retorno' ? 'selected' : '' }}>Retorno de Pausa</option>
                            </select>
                            @error('tipo_registro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Órdenes asociadas (opcional) --}}
                        <div class="mb-4">
                            <label for="ordenes" class="form-label fw-bold">Órdenes Asociadas (opcional)</label>
                            <select name="ordenes[]" id="ordenes" class="form-select @error('ordenes') is-invalid @enderror" multiple size="4">
                                @forelse ($ordenes as $orden)
                                    <option value="{{ $orden->id }}" {{ in_array($orden->id, old('ordenes', [])) ? 'selected' : '' }}>
                                        #{{ $orden->id }} - Cliente: {{ $orden->nombre_cliente ?? 'Sin nombre' }} ({{ ucfirst($orden->estado) }})
                                    </option>
                                @empty
                                    <option value="" disabled>No hay órdenes de servicio activas.</option>
                                @endforelse
                            </select>
                            <div class="form-text">Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar varias.</div>
                            @error('ordenes')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('ordenes.*')
                                <div class="invalid-feedback d-block">Una o más órdenes seleccionadas no son válidas.</div>
                            @enderror
                        </div>

                        {{-- Observación opcional --}}
                        <div class="mb-4">
                            <label for="observacion" class="form-label fw-bold">Observación (opcional)</label>
                            <textarea name="observacion" id="observacion" rows="2" class="form-control">{{ old('observacion') }}</textarea>
                        </div>

                        {{-- Botón de enviar --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg btn-success">
                                <i class="bi bi-clock-fill me-2"></i> Registrar Ahora ({{ now()->format('H:i:s') }})
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted text-center">
                    Tu registro se guardará con la hora exacta del servidor.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
