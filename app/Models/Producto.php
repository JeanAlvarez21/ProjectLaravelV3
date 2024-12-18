<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestaps = false;

    public function detalles_pedidos() 
    {
        return $this->hasMany(Detalles_Pedido::class);
    }

    public function inventario_Products() 
    {
        return $this->hasMany(Inventario_Producto::class);
    }
        
    public function categorias() 
    {
        return $this->belongsTo(Categorias::class);
    }
}
