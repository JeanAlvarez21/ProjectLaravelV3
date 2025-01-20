<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'fecha_pedido',
        'direccion_pedido',
        'total'
    ];

    // Definir las fechas para que Laravel las maneje automáticamente
    protected $dates = [
        'fecha_pedido'
    ];

    // Mutador para asegurar que fecha_pedido siempre sea un objeto Carbon
    public function setFechaPedidoAttribute($value)
    {
        $this->attributes['fecha_pedido'] = $value instanceof Carbon ? $value : Carbon::parse($value);
    }

    // Accessor para asegurar que siempre devolvemos un objeto Carbon
    public function getFechaPedidoAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detalles()
    {
        return $this->hasMany(Detalles_Pedido::class, 'pedido_id');
    }
}