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
        'categoria_id',
    ];

    /**
     * Relación muchos a muchos con órdenes de servicio.
     */
    public function ordenes()
    {
        return $this->belongsToMany(OrdenServicio::class, 'ordenes_materiales', 'material_id', 'orden_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    /**
     * Relación con categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
