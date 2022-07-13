<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstitucionRequest extends FormRequest
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
    public static function rules()
    {
        return [
            'identificacion'=> 'required|unique:institucions',
            'telefono'=>'required',
            'nombre'=>'required',
            'email'=>'max:100|email',
            'inicio_convenio'=>'required|date',
            'tipo'=>'required',
            'term_id'=>'required'
        ];
    }

    /**
     *
     */
    public static function menssages(){
        return [
            'identificacion.required' => 'La indentificación es requeridad',
            'identificacion.unique' => 'La indentificación ingresada ya existe'
        ];
    }
}
