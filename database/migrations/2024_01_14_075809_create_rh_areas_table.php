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
        Schema::create('rh_areas', function (Blueprint $table) {
            $table->id();
            // ** El tipo de dato:  area, departamento, area, departamento, puesto, etc. */
            $table->enum('tipo', ['area', 'departamento', 'puesto']);
            // $table->foreignId('tipo_concepto_id')->constrained('conceptos')->onDelete('restrict');
            $table->string('area', 50)->unique();

            $table->timestamps();
        });

        //** Se relaciona con empleados */
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreignId('area_id')->nullable()->constrained('rh_areas')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rh_areas');
    }
};
