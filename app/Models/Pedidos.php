<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = true; // Se activa porque la migración incluye timestamps

    protected $fillable = [
        'id_usuario',
        'id_estado',
        'fecha_pedido',
        'direccion_pedido',
        'total'
    ];

    // Definir las fechas para que Laravel las maneje automáticamente
    protected $dates = ['fecha_pedido'];

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

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con EstadoPedido
    public function estado()
    {
        return $this->belongsTo(EstadoPedido::class, 'id_estado', 'id');
    }

    // Relación con DetallesPedido (si existe)
    public function detalles()
    {
        return $this->hasMany(Detalles_Pedido::class, 'pedido_id');
    }

    public function getUserOrders()
{
    $pedidos = Pedidos::with('estado')->where('id_usuario', auth()->id())->get();
    return response()->json($pedidos);
}
}