<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules($id)
    {
        return [
            'nit' => 'required|unique:empresas,nit,' . $id,
            'nombres' => 'required',
            'tipo_id' => 'required',
            'email' => 'max:100|email',
            'telefono' => 'required',
            'fecha_convenio' => 'required|date',
            'municipio_id' => 'required'
        ];
    }
    public static function menssages()
    {
        return [
            'nit.unique' => 'el nit de empresa ingresado ya existe',
            'nombres.required' => 'El nombre de la empresa es requerido',
            'tipo_id.required' => 'El tipo de empresa es requerido',
            'email.required' => 'El correo electronico de la empresa es requerido',
            'telefono.required' => 'El telefono de la empresa es requerido',
            'fecha_convenio.required' => 'La fecha de convenio  de la empresa es requerida',
            'municipio_id.required' => 'El municipio es requerido para la empresa'
        ];
    }
}
