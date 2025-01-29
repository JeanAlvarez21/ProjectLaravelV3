<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalles_Pedido extends Model
{
    protected $table = 'detalles_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'proyecto_id',
        'cantidad',
        'subtotal',
        'precio'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id', 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
    public function getNombreItemAttribute()
    {
        return $this->producto ? $this->producto->nombre :
            ($this->proyecto ? $this->proyecto->nombre : 'N/A');
    }


}