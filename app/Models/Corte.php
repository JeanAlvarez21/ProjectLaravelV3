<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'proyecto_id',
        'cantidad',
        'medidas',
        'tipo_borde',
        'color_borde',
        'descripcion_corte',
        'precio_total',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }
}

