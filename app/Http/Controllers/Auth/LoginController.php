<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $role = auth()->user()->rol; // Asume que 'rol' es el campo que identifica el rol del usuario
        return '/home'; // Ruta por defecto si el rol no coincide
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        // Recuperar credenciales guardadas en cookies (si existen)
        $email = Cookie::get('email', '');
        $password = Cookie::get('password', '');
        return view('auth.login', compact('email', 'password'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verificar si el correo existe en la base de datos
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'El correo electrónico no está registrado.',
            ])->withInput($request->except('password'));
        }

        // Intentar autenticar con las credenciales proporcionadas
        $remember = $request->has('remember'); // Verificar si el checkbox "Guardar contraseña" está marcado
        if (!Auth::attempt($request->only('email', 'password'), $remember)) {
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.',
            ])->withInput($request->except('password'));
        }

        // Manejo de la opción "Guardar contraseña" para las cookies (opcional, no recomendado en producción)
        if ($request->has('save-password')) {
            // Guardar email y contraseña en cookies por 7 días
            Cookie::queue('email', $request->email, 10080); // 7 días en minutos
            Cookie::queue('password', $request->password, 10080); // Nota: Esto no es seguro en producción
        } else {
            // Eliminar cookies si no se selecciona "Guardar contraseña"
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }

        // Redirigir al usuario si la autenticación es exitosa
        return redirect()->intended($this->redirectTo());
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        // Redirigir al dashboard según el rol
        switch ($user->rol) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('empleado.dashboard');
            case 3:
                return redirect()->route('cliente.dashboard');
            default:
                return redirect('/home'); // Ruta por defecto si el rol no es reconocido
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
