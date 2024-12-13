<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Indica el nombre de la tabla si no sigue la convención de pluralización
    protected $table = 'roles';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_rol',
    ];

    // Opcional: Si el nombre de la clave primaria no es 'id'
    // protected $primaryKey = 'id_rol';

    // Si no usas autoincremento o el tipo de id no es entero, puedes deshabilitarlo
    // public $incrementing = false;

    // Si la clave primaria no es un entero, puedes definir el tipo
    // protected $keyType = 'string'; 

    // Si no usas timestamps
    // public $timestamps = false;

    // Relación con los usuarios (si la tienes configurada)
    public function users()
    {
        return $this->hasMany(User::class, 'rol', 'id_rol');
    }
}
