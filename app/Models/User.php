<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributos que se pueden asignar masivamente.
     * Se agregó 'role' para que Sonia, Fernando y Víctor funcionen.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <--- IMPORTANTE: Agregado para que no falle el registro
    ];

    /**
     * Atributos ocultos para la serialización (JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casteo de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Función de ayuda para verificar si es administrador
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'dueño';
    }
}