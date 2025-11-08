<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Tecnico;
use App\Models\Material;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    /**
     * Mostrar todas las órdenes de servicio.
     */
    public function index()
    {
        $ordenes = OrdenServicio::with(['tecnicos', 'materiales'])->get();
        return view('ordenes.index', compact('ordenes'));
    }

    /**
     * Mostrar formulario para crear nueva orden.
     */
    public function create()
    {
        $tecnicos = Tecnico::where('estado', 'activo')->get();
        $materiales = Material::with('categoria')->get(); // ✅ si cada material pertenece a una categoría
        return view('ordenes.create', compact('tecnicos', 'materiales'));
    }

    /**
     * Guardar una nueva orden en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string',
            'tecnicos' => 'nullable|array',
            'materiales' => 'nullable|array',
            'materiales.*.cantidad' => 'nullable|integer|min:1',
        ]);

        // ✅ Crear la orden
        $orden = OrdenServicio::create($request->only([
            'nombre_cliente', 'direccion', 'fecha_inicio', 'fecha_fin', 'observaciones'
        ]));

        // ✅ Asignar técnicos si existen
        if ($request->has('tecnicos') && is_array($request->tecnicos)) {
            $orden->tecnicos()->sync($request->tecnicos);
        }

        // ✅ Asignar materiales con cantidad
        if ($request->has('materiales') && is_array($request->materiales)) {
            $syncData = [];
            foreach ($request->materiales as $id => $data) {
                $cantidad = isset($data['cantidad']) && $data['cantidad'] > 0 ? (int) $data['cantidad'] : 0;
                if ($cantidad > 0) {
                    $syncData[$id] = ['cantidad' => $cantidad];
                }
            }
            $orden->materiales()->sync($syncData);
        }

        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio creada correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(OrdenServicio $orden)
    {
        $tecnicos = Tecnico::where('estado', 'activo')->get();
        $materiales = Material::with('categoria')->get(); // ✅ Mostrar agrupados por categoría
        $orden->load(['tecnicos', 'materiales']);
        return view('ordenes.edit', compact('orden', 'tecnicos', 'materiales'));
    }

    /**
     * Actualizar una orden existente.
     */
    public function update(Request $request, OrdenServicio $orden)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string',
            'tecnicos' => 'nullable|array',
            'materiales' => 'nullable|array',
            'materiales.*.cantidad' => 'nullable|integer|min:1',
        ]);

        // ✅ Actualizar orden
        $orden->update($request->only([
            'nombre_cliente', 'direccion', 'fecha_inicio', 'fecha_fin', 'observaciones'
        ]));

        // ✅ Actualizar técnicos
        $orden->tecnicos()->sync($request->tecnicos ?? []);

        // ✅ Actualizar materiales y cantidades
        $syncData = [];
        if ($request->has('materiales') && is_array($request->materiales)) {
            foreach ($request->materiales as $id => $data) {
                $cantidad = isset($data['cantidad']) && $data['cantidad'] > 0 ? (int) $data['cantidad'] : 0;
                if ($cantidad > 0) {
                    $syncData[$id] = ['cantidad' => $cantidad];
                }
            }
        }
        $orden->materiales()->sync($syncData);

        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio actualizada correctamente.');
    }

    /**
     * Eliminar una orden de servicio.
     */
    public function destroy(OrdenServicio $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio eliminada correctamente.');
    }
}
