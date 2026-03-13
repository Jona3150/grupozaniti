<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear la tabla de productos.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');          // Nombre del producto/químico
            $table->string('categoria');       // Categoría (Insecticidas, Accesorios, etc.)
            $table->integer('cantidad');       // Stock actual
            $table->string('unidad_medida');   // L, kg, unidades, etc.
            $table->decimal('precio', 10, 2);  // Precio unitario
            $table->integer('stock_minimo')->default(5); // Umbral para alertas
            $table->string('proveedor');       // Empresa proveedora
            $table->timestamps();              // created_at y updated_at
        });
    }

    /**
     * Revierte las migraciones (borra la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};