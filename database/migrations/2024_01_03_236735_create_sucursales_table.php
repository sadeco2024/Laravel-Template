<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->nullable(false)->unique();
            $table->foreignId('telefono_id')->nullable()->constrained('telefonos')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('direccion_id')->nullable()->constrained('direcciones')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tipo_concepto_id')->nullable()->constrained('conceptos')->onUpdate('cascade')->onDelete('restrict');

            $table->json('ubicacion')->nulleable()->default(new Expression('(JSON_ARRAY())'));
            $table->foreignId('estatus_id')->nullable()->constrained('estatuses')->onUpdate('cascade')->onDelete('restrict');
            

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
