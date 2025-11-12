<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\OrdenServicioController;
use App\Http\Controllers\InformeController;

Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/home', fn() => redirect()->route('dashboard'))->name('home');

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos
    Route::resource('cuentas', CuentaController::class)
        ->parameters(['cuentas' => 'cuenta']);

    Route::resource('transacciones', TransaccionController::class)
        ->parameters(['transacciones' => 'transaccion']);

    Route::resource('usuarios', UsuarioController::class)
        ->parameters(['usuarios' => 'usuario']);
    Route::post('/usuarios/{id}/inactivar', [UsuarioController::class, 'inactivar'])->name('usuarios.inactivar');
    Route::post('/usuarios/{id}/activar', [UsuarioController::class, 'activar'])->name('usuarios.activar');

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
    Route::patch('/materiales/{material}/toggle', [MaterialController::class, 'toggle'])->name('materiales.toggle');

    Route::resource('tecnicos', TecnicoController::class)
        ->parameters(['tecnicos' => 'tecnico']);

    // Ordenes de Servicio
    Route::prefix('ordenes')->name('ordenes.')->group(function () {
        Route::get('/', [OrdenServicioController::class, 'index'])->name('index');
        Route::get('/create', [OrdenServicioController::class, 'create'])->name('create');
        Route::post('/', [OrdenServicioController::class, 'store'])->name('store');
        Route::get('/{orden}/edit', [OrdenServicioController::class, 'edit'])->name('edit');
        Route::put('/{orden}', [OrdenServicioController::class, 'update'])->name('update');
        Route::delete('/{orden}', [OrdenServicioController::class, 'destroy'])->name('destroy');

        // Cambiar estado
        Route::patch('/{orden}/cambiar-estado', [OrdenServicioController::class, 'cambiarEstado'])
            ->name('cambiarEstado');

        // Exportar Excel
        Route::get('/{orden}/excel', [OrdenServicioController::class, 'exportExcel'])->name('excel');
    });

    // Informes PDF y Excel
    Route::get('/informes', [InformeController::class, 'index'])->name('informes.index');
    Route::get('/informes/{orden}/pdf', [InformeController::class, 'generarPdf'])->name('informes.pdf');
    Route::get('/informes/{orden}/excel', [InformeController::class, 'generarExcel'])->name('informes.excel');
});

require __DIR__ . '/auth.php';
