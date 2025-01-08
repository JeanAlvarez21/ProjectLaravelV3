<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCedula implements Rule
{
    public function passes($attribute, $value)
    {
        if (strlen($value) != 10) {
            return false;
        }

        $cedula = str_split($value);
        $suma = 0;

        // Reglas de multiplicación para los primeros 9 dígitos
        $mult = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        for ($i = 0; $i < 9; $i++) {
            $producto = $cedula[$i] * $mult[$i];
            $suma += ($producto >= 10) ? $producto - 9 : $producto;
        }

        $mod = $suma % 10;
        $digitoVerificador = ($mod == 0) ? 0 : 10 - $mod;

        return $cedula[9] == $digitoVerificador;
    }

    public function message()
    {
        return 'La cédula ingresada no es válida.';
    }
}
