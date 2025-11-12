public function exportExcel(OrdenServicio $orden)
{
    $orden->load(['tecnicos', 'materiales']);
    $filename = "orden_{$orden->id}.csv";

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=\"$filename\"",
    ];

    $callback = function() use ($orden) {
        $file = fopen('php://output', 'w');

        fputcsv($file, ['ID', 'Cliente', 'Estado', 'Técnicos', 'Materiales']);

        $tecnicos = $orden->tecnicos->pluck('nombre')->implode(', ');
        $materiales = $orden->materiales->map(fn($m) => $m->nombre . ' x ' . $m->pivot->cantidad)->implode(', ');

        fputcsv($file, [
            $orden->id,
            $orden->nombre_cliente,
            $orden->estado,
            $tecnicos,
            $materiales
        ]);

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
