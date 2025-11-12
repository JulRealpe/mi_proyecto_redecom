<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 🟩 Tabla principal de asistencias
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('tipo_registro'); // Entrada / Salida
            $table->timestamp('fecha_hora')->nullable();
            $table->text('observacion')->nullable();
            $table->timestamps();
        });

        // 🟩 Tabla intermedia entre asistencias y órdenes
        Schema::create('asistencia_orden', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asistencia_id')->constrained('asistencias')->onDelete('cascade');
            $table->foreignId('orden_id')->constrained('ordenes_servicio')->onDelete('cascade'); // 🔹 nombre corregido
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencia_orden');
        Schema::dropIfExists('asistencias');
    }
};
