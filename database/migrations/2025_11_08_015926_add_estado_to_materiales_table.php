<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materiales', function (Blueprint $table) {
            // Añade columna 'estado' sólo si NO existe (seguro en entornos con datos)
            if (! Schema::hasColumn('materiales', 'estado')) {
                $table->string('estado')->default('activo')->after('cantidad');
            }
        });
    }

    public function down(): void
    {
        Schema::table('materiales', function (Blueprint $table) {
            if (Schema::hasColumn('materiales', 'estado')) {
                $table->dropColumn('estado');
            }
        });
    }
};
