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
        Schema::create('tlc_activaciones', function (Blueprint $table) {
            $table->id();

            $table->date('preactivacion');
            $table->date('activacion')->nullable();
            $table->date('primera_llamada')->nullable();
            $table->date('captura_dol')->nullable();
            $table->date('rep_venta')->nullable();
            $table->boolean('ing_tae');
            $table->decimal('monto',5)->nullable();
            $table->string('pagado', 5)->nullable();

            $table->index(['preactivacion', 'telefono_id'])->unique();

            $table->foreignId('telefono_id')->constrained('telefonos');
            $table->foreignId('imei_discreto_id')->nullable()->constrained('articulos_discretos');
            $table->foreignId('iccid_discreto_id')->nullable()->constrained('articulos_discretos');
            $table->foreignId('tipo_concepto_id')->constrained('conceptos');
            $table->foreignId('tlc_canal_id')->constrained('tlc_canales');
            $table->foreignId('tlc_canal_vendedor_id')->constrained('tlc_canales_vendedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tlc_activaciones');
    }
};
