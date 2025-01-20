<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalles_Pedido extends Model
{
    protected $table = 'detalles_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'subtotal'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}