<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'nombre_cliente',
        'direccion',
        'estado',
        'observaciones',
        'usuario_id',
    ];

    // Relación con usuario (técnico)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación muchos a muchos con materiales
    public function materiales()
    {
        return $this->belongsToMany(
            Material::class,
            'ordenes_materiales',
            'orden_id',
            'material_id'
        )
        ->withPivot('cantidad')
        ->withTimestamps();
    }

    // Relación muchos a muchos con asistencias
    public function asistencias()
    {
        return $this->belongsToMany(
            Asistencias::class,
            'asistencia_orden',
            'orden_id',
            'asistencia_id'
        );
    }
}
