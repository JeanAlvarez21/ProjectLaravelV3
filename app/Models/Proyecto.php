<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'user_id',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los cortes
    public function cortes()
    {
        return $this->hasMany(Corte::class);
    }

    // Relación con los detalles de pedido
    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class);
    }

    // Método para calcular el precio total del proyecto
    public function calcularPrecioTotal()
    {
        return $this->cortes->sum(function ($corte) {
            return $corte->calcularPrecio();
        });
    }

    // Método para obtener el estado del proyecto
    public function getEstado()
    {
        return $this->estado ?? 'En progreso';
    }

    // Método para verificar si el proyecto está completado
    public function estaCompletado()
    {
        return $this->estado === 'Completado';
    }

    // Método para obtener la duración del proyecto en días
    public function getDuracion()
    {
        if ($this->fecha_inicio && $this->fecha_fin) {
            return $this->fecha_inicio->diffInDays($this->fecha_fin);
        }
        return null;
    }
}