<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    /**
     * Muestra todas las transacciones.
     */
    public function index()
    {
        $transacciones = Transaccion::with('cuenta')->latest()->get();
        return view('transacciones.index', compact('transacciones'));
    }

    /**
     * Muestra el formulario para crear una nueva transacción.
     */
    public function create()
    {
        $cuentas = Cuenta::all();
        return view('transacciones.create', compact('cuentas'));
    }

    /**
     * Guarda una nueva transacción y actualiza el saldo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cuenta_id'   => 'required|exists:cuentas,id',
            'tipo'        => 'required|in:ingreso,gasto',
            'monto'       => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $transaccion = Transaccion::create($validated);

        // Actualizar saldo
        $cuenta = Cuenta::findOrFail($validated['cuenta_id']);
        $cuenta->saldo += ($validated['tipo'] === 'ingreso')
            ? $validated['monto']
            : -$validated['monto'];
        $cuenta->save();

        return redirect()->route('transacciones.index')
            ->with('success', '✅ Transacción registrada correctamente.');
    }

    /**
     * Muestra una transacción específica.
     */
    public function show(Transaccion $transaccion)
    {
        return view('transacciones.show', compact('transaccion'));
    }

    /**
     * Muestra el formulario para editar una transacción.
     */
    public function edit(Transaccion $transaccion)
    {
        $cuentas = Cuenta::all();
        return view('transacciones.edit', compact('transaccion', 'cuentas'));
    }

    /**
     * Actualiza una transacción existente y ajusta el saldo.
     */
    public function update(Request $request, Transaccion $transaccion)
    {
        $validated = $request->validate([
            'cuenta_id'   => 'required|exists:cuentas,id',
            'tipo'        => 'required|in:ingreso,gasto',
            'monto'       => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Revertir el saldo anterior
        $cuentaAnterior = $transaccion->cuenta;
        $cuentaAnterior->saldo += ($transaccion->tipo === 'ingreso')
            ? -$transaccion->monto
            : $transaccion->monto;
        $cuentaAnterior->save();

        // Actualizar la transacción
        $transaccion->update($validated);

        // Aplicar nuevo saldo
        $nuevaCuenta = Cuenta::findOrFail($validated['cuenta_id']);
        $nuevaCuenta->saldo += ($validated['tipo'] === 'ingreso')
            ? $validated['monto']
            : -$validated['monto'];
        $nuevaCuenta->save();

        return redirect()->route('transacciones.index')
            ->with('success', '✏️ Transacción actualizada correctamente.');
    }

    /**
     * Elimina una transacción y ajusta el saldo.
     */
    public function destroy(Transaccion $transaccion)
    {
        $cuenta = $transaccion->cuenta;

        // Revertir el saldo
        $cuenta->saldo += ($transaccion->tipo === 'ingreso')
            ? -$transaccion->monto
            : $transaccion->monto;
        $cuenta->save();

        $transaccion->delete();

        return redirect()->route('transacciones.index')
            ->with('success', '🗑️ Transacción eliminada correctamente.');
    }
}
