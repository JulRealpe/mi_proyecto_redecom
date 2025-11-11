<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ordenes_materiales', function (Blueprint $table) {
            if (!Schema::hasColumn('ordenes_materiales', 'orden_id')) {
                $table->unsignedBigInteger('orden_id')->after('id');
                $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade');
            }

            if (!Schema::hasColumn('ordenes_materiales', 'material_id')) {
                $table->unsignedBigInteger('material_id')->after('orden_id');
                $table->foreign('material_id')->references('id')->on('materiales')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ordenes_materiales', function (Blueprint $table) {
            $table->dropForeign(['orden_id']);
            $table->dropForeign(['material_id']);
            $table->dropColumn(['orden_id', 'material_id']);
        });
    }
};

