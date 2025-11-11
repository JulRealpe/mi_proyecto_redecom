<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('usuarios')->onDelete('cascade'); // 🔹 corregido
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_tecnicos');
    }
};
