<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServicioTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('direccion');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_servicio');
    }
}
