<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Usuario;
use App\Models\Material;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    /** Listado de órdenes */
    public function index()
    {
        $ordenes = OrdenServicio::with(['usuario', 'materiales'])->get();
        return view('ordenes.index', compact('ordenes'));
    }

    /** Formulario para crear nueva orden */
    public function create()
    {
        $usuarios = Usuario::where('rol', 'tecnico')
                           ->where('estado', 'activo') // minúscula
                           ->get();

        $materiales = Material::where('estado', 'activo')->get();

        return view('ordenes.create', compact('usuarios', 'materiales'));
    }

    /** Guardar nueva orden */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            'observaciones' => 'nullable|string|max:500',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidades_materiales' => 'nullable|array',
        ]);

        $orden = OrdenServicio::create([
            'nombre_cliente' => $request->nombre_cliente,
            'direccion' => $request->direccion,
            'estado' => strtolower($request->estado), // uniformizar
            'observaciones' => $request->observaciones,
            'usuario_id' => $request->usuario_id,
        ]);

        $this->syncMaterials($orden, $request->input('cantidades_materiales', []));

        return redirect()->route('ordenes.index')
                         ->with('success', 'Orden creada correctamente.');
    }

    /** Mostrar detalle de orden */
    public function show(OrdenServicio $orden)
    {
        $orden->load(['usuario', 'materiales']);
        return view('ordenes.show', compact('orden'));
    }

    /** Formulario de edición */
    public function edit(OrdenServicio $orden)
    {
        $usuarios = Usuario::where('rol', 'tecnico')
                           ->where('estado', 'activo')
                           ->get();

        $materiales = Material::where('estado', 'activo')->get();

        return view('ordenes.edit', compact('orden', 'usuarios', 'materiales'));
    }

    /** Actualizar una orden */
    public function update(Request $request, OrdenServicio $orden)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            'observaciones' => 'nullable|string|max:500',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidades_materiales' => 'nullable|array',
        ]);

        $orden->update([
            'nombre_cliente' => $request->nombre_cliente,
            'direccion' => $request->direccion,
            'estado' => strtolower($request->estado),
            'observaciones' => $request->observaciones,
            'usuario_id' => $request->usuario_id,
        ]);

        $this->syncMaterials($orden, $request->input('cantidades_materiales', []));

        return redirect()->route('ordenes.index')
                         ->with('success', 'Orden actualizada correctamente.');
    }

    /** Eliminar una orden */
    public function destroy(OrdenServicio $orden)
    {
        $orden->materiales()->detach();
        $orden->delete();

        return redirect()->route('ordenes.index')
                         ->with('success', 'Orden eliminada correctamente.');
    }

    /** Sincronizar materiales */
    protected function syncMaterials(OrdenServicio $orden, array $cantidades)
    {
        $materialesSync = [];
        foreach ($cantidades as $id => $cantidad) {
            $cantidad = (int) $cantidad;
            if ($cantidad > 0) {
                $materialesSync[$id] = ['cantidad' => $cantidad];
            }
        }
        $orden->materiales()->sync($materialesSync);
    }
}
