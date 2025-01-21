<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'proyectos';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre',
        'ciudad',
        'local',
        'estado',
        'id_producto', // Llave foránea para el producto asociado
    ];

    /**
     * Relación: Un proyecto pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    /**
     * Relación: Un proyecto tiene muchos cortes.
     */
    public function cortes()
    {
    return $this->hasMany(Corte::class, 'proyecto_id');
    }
}
