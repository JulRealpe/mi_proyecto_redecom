<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informes', function (Blueprint $table) {
            // $table->string('tipo', 255)->after('orden_id'); // <-- ¡COMENTAR O ELIMINAR ESTA LÍNEA!
        });
    }

    public function down(): void
    {
        Schema::table('informes', function (Blueprint $table) {
            // $table->dropColumn('tipo'); // Si comentaste el up(), puedes comentar también el down()
        });
    }
};