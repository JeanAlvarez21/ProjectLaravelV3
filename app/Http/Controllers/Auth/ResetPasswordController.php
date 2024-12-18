<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect('/login')->with('status', trans($response));
    }

    public function redirectPath()
    {
        return '/login'; // Cambia aquí la redirección
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Aquí puedes especificar manualmente la redirección
        return redirect('/login')->with('status', 'Contraseña restablecida exitosamente');
    }

}