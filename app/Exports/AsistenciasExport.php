<?php

namespace App\Exports;

use App\Models\Asistencias;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class AsistenciasExport implements FromCollection, WithHeadings
{
    protected $fecha;

    public function __construct($fecha)
    {
        $this->fecha = $fecha;
    }

    public function collection()
    {
        return Asistencias::with(['usuario', 'ordenes'])
            ->whereDate('fecha_hora', $this->fecha)
            ->get()
            ->map(function($asistencia) {
                return [
                    'Técnico' => $asistencia->usuario->nombre ?? 'Eliminado',
                    'Tipo' => ucfirst($asistencia->tipo_registro),
                    'Fecha y Hora' => $asistencia->fecha_hora,
                    'Órdenes Asociadas' => $asistencia->ordenes->pluck('id')->join(', '),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Técnico',
            'Tipo',
            'Fecha y Hora',
            'Órdenes Asociadas',
        ];
    }
}
