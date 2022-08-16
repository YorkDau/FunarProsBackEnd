<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropuestaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static  function rules()
    {
        return [
            'numero_propuesta' => 'required|unique:propuestas',
            'institucion_id' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
            'empresa_id' => 'required',
            'fecha_inicial' => 'required|date'
        ];
    }
    public static function menssages()
    {
        return [
            'numero_propuesta.required' => 'El numero de la propuesta  es requerida',
            'numero_propuesta.required' => 'El número de la propuesta es requerida',
            'institucion_id.required' => 'la Institucion es requerida',
            'tipo_id.required' => 'El tipo de la propuesta  es requerido',
            'empresa_id.required' => 'la  de empresa es requerida',
            'fecha_inicial.required' => 'La fecha inicial de la propuesta es requerida'
        ];
    }
}
