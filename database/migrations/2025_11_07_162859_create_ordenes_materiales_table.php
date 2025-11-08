<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesMaterialesTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_materiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes_servicio')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materiales')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_materiales');
    }
}
