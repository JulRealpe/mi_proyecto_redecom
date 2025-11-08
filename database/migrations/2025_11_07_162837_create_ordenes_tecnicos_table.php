<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTecnicosTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes_servicio')->onDelete('cascade');
            $table->foreignId('tecnico_id')->constrained('tecnicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_tecnicos');
    }
}
