<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_categoria',
        'codigo_producto',
        'precio',
        'costo',
        'stock',
        'min_stock',
        'visible',
        'imagen',
        'nombre_sucursa',
        'doreccion_sucursa', 
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

}