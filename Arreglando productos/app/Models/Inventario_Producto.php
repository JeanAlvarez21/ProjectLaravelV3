<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario_Producto extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestaps = false;
    
    public function productos() 
    {
        return $this->belongsTo(Producto::class);
    }
}
