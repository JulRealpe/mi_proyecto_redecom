<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use Illuminate\Http\Request;

class InformeController extends Controller
{
    // Lista todas las órdenes para generar informes
    public function index()
    {
        $ordenes = OrdenServicio::with(['tecnicos', 'materiales'])->get();
        return view('informes.index', compact('ordenes'));
    }

    // Generar PDF (ya lo tenías con dompdf)
    public function generarPdf(OrdenServicio $orden)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('informes.pdf', compact('orden'));
        return $pdf->download("orden_{$orden->id}.pdf");
    }

    // Método temporal para “Excel” usando CSV
    public function generarExcel(OrdenServicio $orden)
    {
        $filename = "orden_{$orden->id}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($orden) {
            $file = fopen('php://output', 'w');

            // Cabecera
            fputcsv($file, ['Orden ID', 'Cliente', 'Estado']);

            // Datos de la orden
            fputcsv($file, [$orden->id, $orden->nombre_cliente, $orden->estado]);

            // Técnicos
            fputcsv($file, []);
            fputcsv($file, ['Técnicos']);
            foreach ($orden->tecnicos as $tecnico) {
                fputcsv($file, [$tecnico->nombre]);
            }

            // Materiales
            fputcsv($file, []);
            fputcsv($file, ['Materiales', 'Cantidad']);
            foreach ($orden->materiales as $material) {
                fputcsv($file, [$material->nombre, $material->pivot->cantidad]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
