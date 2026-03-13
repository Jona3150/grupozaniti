<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('tipo'); // Comercial, Residencial, etc.
        $table->string('email')->nullable();
        $table->string('telefono');
        $table->string('direccion');
        $table->string('estado')->default('Activo'); // Activo, Inactivo
        $table->integer('servicios_realizados')->default(0);
        $table->date('ultimo_servicio')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
