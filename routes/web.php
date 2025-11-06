<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransaccionController;

// Página pública antes de iniciar sesión
Route::get('/', function () {
    return view('welcome');
});

// 🔹 Dashboard principal después de iniciar sesión
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔹 Alias: "home" apunta al mismo dashboard (para que el navbar funcione)
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// 🔹 Rutas protegidas (solo usuarios autenticados)
Route::middleware('auth')->group(function () {

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Categorías
    Route::resource('categorias', CategoriaController::class);

    // CRUD Cuentas
    Route::resource('cuentas', CuentaController::class);

    // 🔹 CRUD Transacciones
    Route::get('transacciones', [TransaccionController::class, 'index'])->name('transacciones.index');
    Route::get('transacciones/crear', [TransaccionController::class, 'create'])->name('transacciones.create');
    Route::post('transacciones', [TransaccionController::class, 'store'])->name('transacciones.store');
    Route::get('transacciones/{transaccion}/editar', [TransaccionController::class, 'edit'])->name('transacciones.edit');
    Route::put('transacciones/{transaccion}', [TransaccionController::class, 'update'])->name('transacciones.update');
    Route::delete('transacciones/{transaccion}', [TransaccionController::class, 'destroy'])->name('transacciones.destroy');
});

require __DIR__.'/auth.php';
