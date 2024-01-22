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
        Schema::create('rh_extras', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 20)->nullable(false);
            $table->string('descripcion', 100)->nullable(false);
            $table->index(['concepto', 'descripcion'])->unique();
            $table->timestamps();
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->foreignId('area_rh_extra_id')->nullable()->constrained('rh_extras')->onDelete('restrict');
            $table->foreignId('departamento_rh_extra_id')->nullable()->constrained('rh_extras')->onDelete('restrict');
            $table->foreignId('puesto_rh_extra_id')->nullable()->constrained('rh_extras')->onDelete('restrict');
            $table->foreignId('tipo_contrato_rh_extra_id')->nullable()->constrained('rh_extras')->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rh_extras');
    }
};
