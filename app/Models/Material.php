<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    protected $fillable = [
        'nombre',
        'cantidad',
        'estado',
        'categoria_id', // ✅ si tu tabla materiales tiene esta columna
    ];

    /**
     * Relación muchos a muchos con las órdenes de servicio.
     */
    public function ordenes()
    {
        return $this->belongsToMany(OrdenServicio::class, 'material_orden')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    /**
     * Relación con la categoría del material.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
