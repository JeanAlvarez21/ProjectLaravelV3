<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Esto es opcional, solo si el nombre de la tabla no sigue la convención
    protected $primaryKey = 'id_categoria'; // Definir la clave primaria
    protected $fillable = ['nombre_categoria']; // Campos asignables en masa
    public $timestamps = false; // Si no estás utilizando timestamps

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}