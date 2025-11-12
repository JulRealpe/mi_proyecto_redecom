<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    protected $table = 'informes';

    protected $fillable = [
        'orden_id',
        'tipo',
        'fecha_generacion',
        'usuario_id'
    ];

    public function orden()
    {
        return $this->belongsTo(OrdenServicio::class, 'orden_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
