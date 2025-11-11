<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_materiales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('cantidad')->default(1);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materiales')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_materiales');
    }
};
