<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_producto',  // Cambiado de producto_id a id_producto
        'proyecto_id',
        'cantidad',
        'medidas',
        'tipo_borde',
        'color_borde',
        'descripcion_corte',
        'precio_total',
        'fecha_corte',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}