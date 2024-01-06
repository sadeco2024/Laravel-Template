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
        Schema::create('nombres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250)->unique()->nullable(false);
            $table->string('primer_nombre', 50)->nullable(false);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('paterno', 50)->nullable(false);
            $table->string('materno', 50)->nullable();    
            $table->foreignId('curp_id')->nullable(true)->constrained('curps')->onDelete('restrict')->onUpdate('cascade');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nombres');
    }
};
