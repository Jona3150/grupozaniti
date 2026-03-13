<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Forzamos el nombre de la tabla por si Laravel intenta buscar "clientes" de forma errónea
    protected $table = 'clientes';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre',
        'tipo',
        'email',
        'telefono',
        'direccion',
        'estado',
        'servicios_realizados',
        'ultimo_servicio'
    ];

    // Valores por defecto para nuevos registros
    protected $attributes = [
        'estado' => 'Activo',
        'servicios_realizados' => 0,
    ];
}