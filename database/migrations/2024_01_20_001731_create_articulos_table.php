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

        Schema::create('lineas_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('linea', 100);
            $table->string('icono', 100)->nullable(true);

            $table->foreignId('estatus_id')->constrained('estatuses');
            $table->timestamps();
        });


        Schema::create('categorias_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 100);
            $table->foreignId('estatus_id')->constrained('estatuses');
            $table->timestamps();
        });

        // ** Tabla pivote
        Schema::create('categoria_linea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_articulo_id')->constrained('categorias_articulos');
            $table->foreignId('linea_articulo_id')->constrained('lineas_articulos');
            // $table->timestamps();
        });        

        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable(false);
            $table->boolean('almacenable')->default(true);
            
            $table->string('unidad_venta',5)->default('pza');
            
            $table->foreignId('categoria_linea_id')->constrained('categoria_linea');
            $table->foreignId('estatus_id')->constrained('estatuses');

            $table->timestamps();
        });

        Schema::create('claves_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 25);
            $table->string('rol_clave')->default('principal');
            $table->unique(['clave', 'rol_clave']);

            $table->foreignId('articulo_id')->constrained('articulos');
            $table->foreignId('estatus_id')->constrained('estatuses');

            $table->timestamps();
        });

        Schema::create('articulos_discretos', function (Blueprint $table) {
            $table->id();
            $table->string('serie', 25)->unique();
            $table->integer('long')->nullable()->comment('Longitud para verificar una serie larga'); 
            $table->string('tipo', 1)->default('S')->comment('S: Serie, L: Lote');

            $table->foreignId('articulo_id')->nullable()->constrained('articulos');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos_discretos');

        Schema::dropIfExists('claves_articulos');
        Schema::dropIfExists('articulos');

        Schema::dropIfExists('categoria_linea');
        Schema::dropIfExists('categorias_articulos');

        Schema::dropIfExists('linea_grupo');
        Schema::dropIfExists('lineas_articulos');
               
        Schema::dropIfExists('grupos_articulos');
        
        
        
    }
};
