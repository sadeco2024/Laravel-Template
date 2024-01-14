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
        Schema::create('cg_modulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('icono')->default('bi bi-menu-button');
            $table->string('slug')->nullable(false);
            $table->decimal('precio', 8, 2)->default(700);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cg_modulos');
    }
};
