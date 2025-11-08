<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'rol',
        'estado',
    ];

    public $timestamps = true; // porque tu tabla tiene created_at y updated_at
}