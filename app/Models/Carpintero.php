<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Carpintero extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especialidad',
        'telefono',
        'email',
        'foto_perfil',
        'descripcion',
        'disponibilidad',
        'ubicacion'
    ];

    protected $casts = [
        'disponibilidad' => 'boolean',
    ];

    public function getFotoPerfilAttribute($value)
    {
        return $value ? asset($value) : asset('images/default_image.jpg');
    }
}

