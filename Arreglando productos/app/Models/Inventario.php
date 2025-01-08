<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_inventario';
    protected $fillable = [
        'id_producto',
        'cantidad_disponible',
        'precio_unitario',
        'descripcion',
        'nombre_sucursal',
        'direccion_sucursal'
    ];

    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}