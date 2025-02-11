<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        switch (Auth::user()->rol) {
            case 1: // Administrador
                return view('welcome'); // Vista para administradores
            case 2: // Empleado
                return view('roles.empleado'); // Vista para empleados
            case 3: // Cliente
                return view('roles.cliente'); // Vista para clientes
            default: // Rol desconocido
                return redirect('/home')->with('error', 'No tienes permiso para acceder a esta página.');
        }
    }
}
