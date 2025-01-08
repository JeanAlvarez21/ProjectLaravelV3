<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Puedes pasar datos a la vista si lo necesitas
        $data = [
            'phone' => '+420 000 000 000',
            'address' => [
                'street' => 'Avenida Zoilo Rodriguez',
                'city' => 'Virgilio Abarca'
            ],
            'postal' => [
                'street' => 'Na Plzeňce 1166/0',
                'code' => '150 00'
            ]
        ];

        return view('contact', $data);
    }

    // Método opcional para procesar el formulario de contacto si lo agregas después
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        // Aquí puedes agregar la lógica para procesar el formulario
        // Por ejemplo, enviar un email o guardar en base de datos

        return redirect()->back()->with('success', 'Mensaje enviado correctamente');
    }
}