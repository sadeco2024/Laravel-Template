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
        Schema::create('tlc_canales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('clave', 30)->unique();
            $table->string('direccion', 255)->nullable();
            $table->boolean('activa')->default(true);
            $table->string('acox',15)->unique();
            $table->string('contrasena',20)->nullable();
            $table->boolean('enabled')->default(true);

            $table->boolean('question')->default(false); // Servirá para saber si ya se configuró la pregunta secreta del canal.

            $table->foreignId('tipo_concepto_id')->nullable()->constrained('conceptos');
            $table->foreignId('municipio_id')->nullable()->constrained('municipios');
            $table->foreignId('estado_id')->nullable()->constrained('estados');
            $table->foreignId('sucursal_id')->default(1)->constrained('sucursales');
            $table->foreignId('estatus_id')->constrained('estatuses');
            $table->timestamps();
        });

        Schema::create('tlc_canales_vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('login', 20);
            $table->string('logunico', 20)->uniqid();
            $table->string('contrasena', 20)->nullable();
            $table->string('calta', 7)->nullable();
            $table->date('fecha_alta')->nullable();
           
            $table->foreignId('tlc_canal_id')->constrained('tlc_canales');
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tlc_canales_vendedores');
        Schema::dropIfExists('tlc_canales');
        
    }
};
