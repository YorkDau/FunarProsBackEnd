<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InstitucionTipoContratoRule implements Rule
{
    private string $tipo;

    public function __construct(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function passes($attribute, $value)
    {
        if ($this->tipo == 'CONTRATO PAE') {
            return isset($value);
        }
        return true;
    }

    public function message()
    {
        return 'La institución es requerida.';
    }
}
