<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'proyecto_id', 'cantidad', 'largo', 'ancho', 'espesor', 'precio_corte'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}

