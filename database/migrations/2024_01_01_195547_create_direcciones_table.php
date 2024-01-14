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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 100)->nullable(false);
            $table->string('numero_exterior', 10)->nullable();
            $table->string('numero_interior', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->string('codigo_postal', 5)->nullable();
            $table->string('ubicacion',255)->nullable();

            $table->foreignId('ciudad_id')->nullable()->constrained('ciudades')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('estado_id')->nullable(false)->constrained('estados')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('municipio_id')->nullable(false)->constrained('municipios')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('referencia_id')->nullable()->constrained('referencias')->onUpdate('cascade')->onDelete('restrict');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
