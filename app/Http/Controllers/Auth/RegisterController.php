<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'unique:users,cedula'],
            'telefono' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'cedula.unique' => 'La cédula ya está registrada.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'required' => 'El campo :attribute es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Crear al usuario con los datos del formulario
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'direccion' => $data['direccion'],
            'cedula' => $data['cedula'],
            'telefono' => $data['telefono'],
            'rol' => 3, // Asigna el rol automáticamente
        ]);
    }

    // Muestra la pantalla de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

}
