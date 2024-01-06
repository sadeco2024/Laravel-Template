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


        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('nombre_id')->constrained('nombres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('telefono_id')->nullable()->constrained('telefonos');
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->foreignId('corpo_telefono_id')->nullable()->constrained('telefonos');
            $table->string('no_empleado', 20)->unique()->nullable(true);
            $table->foreignId('jefe_user_id')->nullable()->constrained('users');
            $table->foreignId('puesto_id')->nullable()->constrained('rh_puestos');
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId(('estatus_id'))->constrained('estatuses')->onDelete('cascade');;
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
