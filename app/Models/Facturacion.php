<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestaps = false;
    
    public function pedidos() 
    {
        return $this->belongsTo(Pedidos::class);
    }
}
