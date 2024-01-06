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
        Schema::create('cg_menus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ruta');
            $table->string('icono')->default('bi bi-menu-button');
            $table->string('padre')->nullable();
            // $table->string('permiso')->nullable();
            $table->string('orden')->nullable();
            
            $table->foreignId('tipo_concepto_id')->nullable(false)->constrained('conceptos')->onDelete('restrict');
            $table->foreignId('cg_modulo_id')->nullable(false)->constrained('cg_modulos')->onDelete('restrict');
            
            /*
            $table->string('nivel')->nullable();
            $table->string('ruta_padre')->nullable();
            $table->string('color');
            $table->string('descripcion');
            $table->string('estatus');
            $table->string('tipo');
            $table->string('jerarquia');

            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cg_menus');
    }
};
