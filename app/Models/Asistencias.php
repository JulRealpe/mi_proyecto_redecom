<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    use HasFactory;

    protected $table = 'asistencias'; // Nombre de la tabla

    protected $fillable = [
        'usuario_id',
        'tipo_registro',
        'fecha_hora',
        'observacion',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación muchos a muchos con órdenes
    public function ordenes()
    {
        return $this->belongsToMany(
            OrdenServicio::class,
            'asistencia_orden',  // Nombre de la tabla pivote
            'asistencia_id',     // FK de asistencias
            'orden_id'           // FK de ordenes_servicio
        );
    }
}
