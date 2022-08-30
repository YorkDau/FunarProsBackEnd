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
            'empresa_contratista_id'=>'required',
            'empresa_beneficiaria_id' =>'required',
            'tipo' => 'required',
            'fecha_inicial' => 'required|date'
        ];
    }
    public static function menssages()
    {
        return [
            'numero_propuesta.required' => 'El numero de la propuesta  es requerida',
            'empresa_beneficiaria_id.required' => 'La empresa beneficiaria es requerida',
            'empresa_contratista_id.required' => 'La empresa contratista es requerida',
            'tipo.required' => 'El tipo de la propuesta  es requerido',
            'fecha_inicial.required' => 'La fecha inicial de la propuesta es requerida'
        ];
    }
}
