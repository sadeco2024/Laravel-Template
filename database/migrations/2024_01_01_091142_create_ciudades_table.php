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
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id();
            $table->string('ciudad', 50)->nullable(false);
            $table->string('abreviatura', 5)->unique()->nullable(true);
            $table->foreignId('municipio_id')->nullable()->constrained('municipios')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('estado_id')->nullable()->constrained('estados')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            //quiero que haya un index unico de ciudad,mnicipio y estado
            $table->unique(['ciudad','municipio_id','estado_id']);
            

        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciudades');
    }
};
