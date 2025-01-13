<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidCedula;

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
            'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'direccion' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'unique:users,cedula', 'digits:10', new ValidCedula],
            'telefono' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com|yahoo\.com|aol\.com|icloud\.com|live\.com)$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'cedula.unique' => 'La cédula ya está registrada.',
            'cedula.valid_cedula' => 'La cédula introducida no es válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'required' => 'El campo :attribute es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'nombres.regex' => 'El campo nombres solo puede contener letras y espacios.',
            'apellidos.regex' => 'El campo apellidos solo puede contener letras y espacios.',
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
        // Formatear los campos para que la primera letra de cada palabra esté en mayúscula
        $nombres = ucwords(strtolower($data['nombres']));
        $apellidos = ucwords(strtolower($data['apellidos']));
        $direccion = ucwords(strtolower($data['direccion']));

        // Crear al usuario con los datos del formulario
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'direccion' => $direccion,
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

    public function validateCedula($cedula)
    {
        // Verifica si la cédula tiene 10 dígitos
        if (strlen($cedula) != 10) {
            return false;
        }

        // Obtiene los primeros 9 dígitos y el dígito verificador
        $cedula = str_split($cedula);
        $suma = 0;

        // Reglas de multiplicación para los primeros 9 dígitos
        $mult = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        for ($i = 0; $i < 9; $i++) {
            $suma += $cedula[$i] * $mult[$i];
        }

        // Calcula el residuo y el dígito verificador
        $mod = $suma % 10;
        $digitoVerificador = ($mod == 0) ? 0 : 10 - $mod;

        // Verifica si el último dígito de la cédula coincide con el digito verificador
        return $cedula[9] == $digitoVerificador;
    }
}


