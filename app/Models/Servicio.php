<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     * @var string
     */
    protected $table = 'servicios';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     * Estos deben coincidir exactamente con las columnas de tu migración.
     * @var array
     */
    protected $fillable = [
        'fecha',
        'hora',
        'cliente',
        'tipo_servicio',
        'direccion',
        'tecnico', // Aquí se guardará el nombre de Sonia, Fernando o Víctor
        'notas',
        'estado'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
        // La hora se maneja como string para evitar conflictos de formato con los inputs de tipo time
        'hora' => 'string',
    ];

    /**
     * Opcional: Si deseas que Laravel siempre formatee la fecha de cierta forma al convertir a JSON
     */
    protected $dateFormat = 'Y-m-d H:i:s';
}