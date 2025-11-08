<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'nombre_cliente', 'direccion', 'fecha_inicio', 'fecha_fin', 'observaciones'
    ];

    // Relación con técnicos
    public function tecnicos()
    {
        return $this->belongsToMany(Tecnico::class, 'ordenes_tecnicos', 'orden_id', 'tecnico_id')
                    ->withTimestamps();
    }

    // Relación con materiales
    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'ordenes_materiales', 'orden_id', 'material_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
