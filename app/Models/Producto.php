<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     */
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
     * Esto asegura que el precio siempre sea tratado como un número decimal 
     * y la cantidad como entero al llegar a AngularJS.
     */
    protected $casts = [
        'precio' => 'float',
        'cantidad' => 'integer',
        'stock_minimo' => 'integer',
    ];
}
