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
        'fecha_inicio',
        'fecha_fin',
        'observaciones'
    ];

    /**
     * Relación muchos a muchos con los técnicos (usuarios que actúan como técnicos)
     */
    public function tecnicos()
    {
        return $this->belongsToMany(Usuario::class, 'ordenes_tecnicos', 'orden_id', 'tecnico_id')
                    ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con materiales
     */
    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'ordenes_materiales', 'orden_id', 'material_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
