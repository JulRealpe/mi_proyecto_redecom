<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\OrdenServicioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página pública (inicio antes del login)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard principal
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Alias /home → redirige al dashboard
Route::get('/home', fn() => redirect()->route('dashboard'))->name('home');

// Grupo de rutas protegidas (solo autenticados)
Route::middleware('auth')->group(function () {

    /** Perfil del usuario autenticado */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Cuentas */
    Route::resource('cuentas', CuentaController::class)
        ->parameters(['cuentas' => 'cuenta']);

    /** Transacciones */
    Route::resource('transacciones', TransaccionController::class)
        ->parameters(['transacciones' => 'transaccion']); // ✅ Corrige el parámetro

    /** Usuarios */
    Route::resource('usuarios', UsuarioController::class)
        ->parameters(['usuarios' => 'usuario']);

    /** Materiales */
    Route::resource('materiales', MaterialController::class)
        ->parameters(['materiales' => 'material'])
        ->names([
            'index' => 'materiales.index',
            'create' => 'materiales.create',
            'store' => 'materiales.store',
            'show' => 'materiales.show',
            'edit' => 'materiales.edit',
            'update' => 'materiales.update',
            'destroy' => 'materiales.destroy',
        ]);

    /** Técnicos */
    Route::resource('tecnicos', TecnicoController::class)
        ->parameters(['tecnicos' => 'tecnico']);

    /** Órdenes de Servicio */
    Route::resource('ordenes', OrdenServicioController::class)
        ->parameters(['ordenes' => 'orden'])
        ->names([
            'index' => 'ordenes.index',
            'create' => 'ordenes.create',
            'store' => 'ordenes.store',
            'show' => 'ordenes.show',
            'edit' => 'ordenes.edit',
            'update' => 'ordenes.update',
            'destroy' => 'ordenes.destroy',
        ]);
});

require __DIR__ . '/auth.php';
