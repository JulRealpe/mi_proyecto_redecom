<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->id();

            // Orden relacionado (borrar en cascada)
            $table->foreignId('orden_id')
                  ->constrained('ordenes_servicio')
                  ->onDelete('cascade');

            $table->string('tipo'); // ejemplo: 'PDF', 'Excel', 'Ambos'
            $table->dateTime('fecha_generacion')->nullable();

            // Usuario relacionado (nullable con set null)
            $table->unsignedBigInteger('usuario_id')->nullable();

            $table->timestamps();

            // Definir la clave foránea de usuario aparte
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
