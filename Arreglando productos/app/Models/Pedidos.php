<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestaps = false;

    public function detalles_pedidos() 
    {
        return $this->hasMany(Detalles_Pedido::class);
    }
    public function facturacions() 
    {
        return $this->hasMany(Facturacion::class);
    }

    public function usuarios() 
    {
        return $this->belongsTo(User::class);
    }
}
