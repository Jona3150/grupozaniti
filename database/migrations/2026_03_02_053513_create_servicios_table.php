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
        // Agregamos una verificación para evitar el error de "Table already exists"
        if (!Schema::hasTable('servicios')) {
            Schema::create('servicios', function (Blueprint $table) {
                $table->id();
                $table->date('fecha');
                $table->time('hora');
                $table->string('cliente');
                $table->string('tipo_servicio');
                $table->string('direccion');
                $table->string('tecnico');
                $table->text('notas')->nullable(); // Permite que el campo esté vacío sin dar error
                $table->string('estado')->default('Programado');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};