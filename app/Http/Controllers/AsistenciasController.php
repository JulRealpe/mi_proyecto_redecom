<?php

namespace App\Http\Controllers;

use App\Models\Asistencias;
use App\Models\OrdenServicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Carbon\Carbon;
use App\Exports\AsistenciasExport; // Asegúrate de crear esta clase

class AsistenciasController extends Controller
{
    /** 🟢 Listado de asistencias */
    public function index(Request $request)
    {
        $usuarios = Usuario::where('estado', 'activo')->get();

        $asistencias = Asistencias::with(['usuario', 'ordenes'])
            ->when($request->fecha, fn($q) => $q->whereDate('fecha_hora', $request->fecha))
            ->when($request->usuario_id, fn($q) => $q->where('usuario_id', $request->usuario_id))
            ->latest()
            ->get();

        return view('asistencias.index', compact('asistencias', 'usuarios'));
    }

    /** 🟢 Formulario para registrar asistencia */
    public function create()
    {
        $usuarios = Usuario::where('estado', 'activo')->get();
        $ordenes = OrdenServicio::whereIn('estado', ['Inicio', 'Proceso'])->get();

        return view('asistencias.create', compact('usuarios', 'ordenes'));
    }

    /** 🟢 Guardar nueva asistencia */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'tipo_registro' => 'required|string',
            'observacion' => 'nullable|string|max:255',
            'ordenes' => 'nullable|array',
            'ordenes.*' => 'exists:ordenes_servicio,id',
        ]);

        $asistencia = Asistencias::create([
            'usuario_id' => $validated['usuario_id'],
            'tipo_registro' => $validated['tipo_registro'],
            'fecha_hora' => now(),
            'observacion' => $validated['observacion'] ?? null,
        ]);

        if (!empty($validated['ordenes'])) {
            $asistencia->ordenes()->sync($validated['ordenes']);
        }

        return redirect()->route('asistencias.index')
                         ->with('success', '✅ Asistencia registrada correctamente.');
    }

    /** 🟢 Ver detalle de asistencia */
    public function show($id)
    {
        $asistencia = Asistencias::with(['usuario', 'ordenes'])->findOrFail($id);
        return view('asistencias.show', compact('asistencia'));
    }

    /** 🟢 Exportar PDF de asistencias */
    public function exportPdf(Request $request)
    {
        $fecha = $request->input('fecha', Carbon::today()->toDateString());

        // Se renombró a $registros para coincidir con la vista
        $registros = Asistencias::with(['usuario', 'ordenes'])
            ->whereDate('fecha_hora', $fecha)
            ->get();

        $pdf = PDF::loadView('asistencias.pdf', compact('registros', 'fecha'));
        return $pdf->download('asistencias_'.$fecha.'.pdf');
    }

    /** 🟢 Exportar Excel de asistencias */
    public function exportExcel(Request $request)
    {
        $fecha = $request->input('fecha', Carbon::today()->toDateString());
        return Excel::download(new AsistenciasExport($fecha), 'asistencias_'.$fecha.'.xlsx');
    }
}
