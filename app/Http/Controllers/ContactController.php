<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $maxMessageLength = 1000; // Define the max message length

    public function index()
    {
        $data = [
            'phone' => '+593 7-257-9891',
            'email' => 'info@novocentro.com',
            'address' => [
                'street' => 'Av. Salvador Bustamante Celi',
                'city' => 'Loja',
                'code' => '110150'
            ],
            'hours' => [
                'weekdays' => '8:00 AM - 6:00 PM',
                'saturday' => '9:00 AM - 2:00 PM'
            ],
            'maxMessageLength' => $this->maxMessageLength // Pass this to the view
        ];

        return view('contact', $data);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|min:3',
            'email' => 'required|email',
            'asunto' => 'required|min:3',
            'mensaje' => 'required|min:10|max:' . $this->maxMessageLength
        ]);

        // Enviar el correo
        Mail::to('cuentitaperrona@gmail.com')->send(new ContactFormMail($validated));

        return redirect()->back()->with('success', 'Mensaje enviado correctamente. Gracias por contactarnos.');
    }
}