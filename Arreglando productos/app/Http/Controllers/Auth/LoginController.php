<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Muestra la pantalla de registro
    public function showLoginForm()
    {
        return view('auth.login');
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
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.',
            ])->withInput($request->except('password'));
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

    /**
     * Cierra la sesión del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
