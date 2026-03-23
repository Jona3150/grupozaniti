<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Importamos el Trait

class Producto extends Model
{
    use HasFactory, SoftDeletes; // 2. Activamos el borrado lógico

    protected $table = 'productos';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'nombre',
        'categoria',
        'cantidad',
        'unidad_medida',
        'precio',
        'stock_minimo',
        'proveedor'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     */
    protected $casts = [
        'precio' => 'float',
        'cantidad' => 'integer',
        'stock_minimo' => 'integer',
        'deleted_at' => 'datetime', // 3. Aseguramos el tratamiento de la fecha de borrado
    ];
}