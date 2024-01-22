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
            // GENERALES
            $table->foreignId('user_id')->unique()->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('nombre_id')->constrained('nombres')->onDelete('cascade')->onUpdate('cascade');
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('genero', 5)->nullable();
            // CONTACTO
            $table->foreignId('telefono_id')->nullable()->constrained('telefonos');
            $table->foreignId('correo_id')->nullable()->constrained('correos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('corpo_telefono_id')->nullable()->constrained('telefonos');
            $table->foreignId('corpo_correo_id')->nullable()->constrained('correos')->onDelete('cascade')->onUpdate('cascade');
            // RECURSOS HUMANOS
            $table->foreignId('rfc_id')->nullable()->constrained('rfcs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->string('no_empleado', 20)->unique()->nullable(true);
            $table->decimal('sueldo', 10, 2)->nullable();
            $table->string('cuenta_banco')->nullable();
            $table->foreignId('direccion_id')->constrained('direcciones')->onDelete('cascade')->onUpdate('cascade');
            // CONTROL
            $table->foreignId(('estatus_id'))->constrained('estatuses')->onDelete('cascade');
            $table->longText('observaciones')->nullable();
            $table->boolean('enabled')->default(true);
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });        

        //** Se establecen las llaves foraneas  */
        //TODO: cambiar el default, por el usuario socio, no super admin.

        Schema::table('sucursales', function (Blueprint $table) {
            $table->foreignId('gerente_empleado_id')->nullable()->constrained('empleados')->onDelete('restrict');
            $table->foreignId('supervisor_empleado_id')->nullable()->constrained('empleados')->onDelete('restrict');
            $table->foreignId('encargado_empleado_id')->nullable()->constrained('empleados')->onDelete('restrict');
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
