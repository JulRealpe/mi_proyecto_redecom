@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Banner superior -->
    <div class="text-center mb-4">
        <img src="https://www.polisura.edu.co/wp-content/uploads/2025/03/electricidad.jpg" 
             alt="Redecom Ingeniería"
             class="img-fluid rounded-4 shadow-lg"
             style="max-height: 280px; object-fit: cover; width: 100%;">
    </div>

    <h1 class="mb-4 text-center fw-bold text-primary">REDECOM INGENIRIA S.A.S</h1>
    <p>Diseño de instalaciones eléctricas, mantenimiento y automatización industrial.</p>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row g-4 justify-content-center">

    </div>
</div>
@endsection
