<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoToTecnicosTable extends Migration
{
    public function up()
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->string('estado')->default('activo'); 
        });
    }

    public function down()
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
