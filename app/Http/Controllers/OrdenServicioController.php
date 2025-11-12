<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Tecnico;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrdenServicioController extends Controller
{
    // Listado de órdenes
    public function index()
    {
        $ordenes = OrdenServicio::with(['tecnicos', 'materiales'])->get();
        return view('ordenes.index', compact('ordenes'));
    }

    // Formulario para crear nueva orden
    public function create()
    {
        $tecnicos = Tecnico::all();
        $materiales = Material::all();
        return view('ordenes.create', compact('tecnicos', 'materiales'));
    }

    // Guardar nueva orden
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            // CORRECCIÓN 1: Observaciones (plural)
            'observaciones' => 'nullable|string|max:500', 
            'tecnicos' => 'array',
            // CORRECCIÓN 2: Nuevo nombre de input de materiales
            'cantidades_materiales' => 'nullable|array',
        ]);

        $orden = OrdenServicio::create([
            'nombre_cliente' => $request->nombre_cliente,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
            // CORRECCIÓN 3: Observaciones (plural)
            'observaciones' => $request->observaciones,
        ]);

        // Relacionar técnicos
        if ($request->tecnicos) {
            $orden->tecnicos()->sync($request->tecnicos);
        }

        // CORRECCIÓN 4: Usar la nueva lógica para materiales
        $this->syncMaterials($orden, $request->input('cantidades_materiales', []));

        return redirect()->route('ordenes.index')->with('success', 'Orden creada correctamente.');
    }

    // Mostrar detalle de una orden
    public function show(OrdenServicio $orden)
    {
        $orden->load(['tecnicos', 'materiales']);
        return view('ordenes.show', compact('orden'));
    }

    // Editar una orden
    public function edit($id)
    {
        $orden = OrdenServicio::with(['tecnicos', 'materiales'])->findOrFail($id);
        $tecnicos = Tecnico::all();
        $materiales = Material::all();

        return view('ordenes.edit', compact('orden', 'tecnicos', 'materiales'));
    }

    // Actualizar una orden
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            // CORRECCIÓN 5: Observaciones (plural)
            'observaciones' => 'nullable|string|max:500', 
            'tecnicos' => 'array',
            // CORRECCIÓN 6: Nuevo nombre de input de materiales
            'cantidades_materiales' => 'nullable|array', 
        ]);

        $orden = OrdenServicio::findOrFail($id);
        $orden->update([
            'nombre_cliente' => $request->nombre_cliente,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
            // CORRECCIÓN 7: Observaciones (plural)
            'observaciones' => $request->observaciones,
        ]);

        // Actualizar técnicos
        $orden->tecnicos()->sync($request->tecnicos ?? []);

        // CORRECCIÓN 8: Usar la nueva lógica para materiales
        $this->syncMaterials($orden, $request->input('cantidades_materiales', []));

        return redirect()->route('ordenes.index')->with('success', 'Orden actualizada correctamente.');
    }

    // Eliminar una orden
    public function destroy($id)
    {
        $orden = OrdenServicio::findOrFail($id);
        $orden->tecnicos()->detach();
        $orden->materiales()->detach();
        $orden->delete();

        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada correctamente.');
    }

    // ** NUEVA FUNCIÓN AUXILIAR **
    /**
     * Procesa y sincroniza los materiales con la orden, excluyendo las cantidades de 0.
     */
    protected function syncMaterials(OrdenServicio $orden, array $cantidades)
    {
        $materialesSincronizar = [];
        
        foreach ($cantidades as $materialId => $cantidad) {
            $cantidad_int = (int)$cantidad;
            // Solo incluimos el material si la cantidad es mayor a 0
            if ($cantidad_int > 0) {
                $materialesSincronizar[$materialId] = ['cantidad' => $cantidad_int];
            }
        }
        $orden->materiales()->sync($materialesSincronizar);
    }
    
    // Exportar CSV
    public function exportExcel(OrdenServicio $orden)
    {
        $orden->load(['tecnicos', 'materiales']);
        $filename = "orden_{$orden->id}.csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        return response()->stream(function() use ($orden) {
            $file = fopen('php://output', 'w');

            // Cabeceras
            fputcsv($file, ['ID', 'Cliente', 'Dirección', 'Estado', 'Observaciones', 'Técnicos', 'Materiales']);

            // Datos
            $tecnicos = $orden->tecnicos->pluck('nombre')->implode(', ');
            $materiales = $orden->materiales
                ->map(fn($m) => $m->nombre . ' x ' . $m->pivot->cantidad)
                ->implode(', ');

            fputcsv($file, [
                $orden->id,
                $orden->nombre_cliente,
                $orden->direccion,
                $orden->estado,
                $orden->observaciones, // <-- CORRECCIÓN FINAL
                $tecnicos,
                $materiales
            ]);

            fclose($file);
        }, 200, $headers);
    }
}