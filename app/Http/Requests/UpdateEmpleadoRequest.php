<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
    public static function rules($id)
    {

        return [
            'tipo_identificacion_id' => 'required',
            'identificacion' => 'required|unique:empleados,identificacion,' . $id,
            'fecha_expedicion_documento' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'numero_telefono' => 'required',
            'genero_id' => 'required',
            'email' => 'required|max:100|email',
            'fecha_nacimiento' => 'required|date',
            'ocupacion' => 'required',
            'nivel_escolaridad_id' => 'required',
            'direccion' => 'max:100',
            'soporte_documento' => 'required'
        ];
    }
    public static function menssages()
    {
        return [
            'tipo_identificacion_id.required' => 'La indentificación es requerida',
            'identificacion.unique' => 'La indentificación ingresada ya existe',
            'fecha_expedicion_documento.required' => 'La fecha de expedición del documento es requerida',
            'nombres.required' => 'El nombre del empleado es requerido',
            'apellidos.required' => 'El apellido del empleado es requerido',
            'email.required' => 'El correo electronico del empleado es requerido',
            'fecha_nacimiento.required' => 'La fecha del empleado es requerida',
            'ocupacion.required' => 'La ocupación del empleado es requerida',
            'nivel_escolaridad_id.required' => 'La escolaridad del empleado es requerida',
            'soporte_documento.required' => 'El documento del empleado es requerido'

        ];
    }
}
