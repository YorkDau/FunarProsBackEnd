<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Http\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('genero', 'documento', 'escolaridad')->paginate(7);

        return Utils::responseJson(
            Response::HTTP_OK,
            $empleados->count() === 0 ? 'No hay empleados registrados' : 'Datos encontrados satisfactoriamente',
            $empleados,
            Response::HTTP_OK
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpleadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), StoreEmpleadoRequest::rules(), StoreEmpleadoRequest::menssages());
        if ($validate->fails()) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudó guardar el empleado, intente nuevamente',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
        try {
            $empleado = new Empleado($request->all());
            foreach ($empleado->attributesToArray() as $key => $value) {
                if ($key !== 'email' && $key !== 'soporte_documento') {
                    $empleado->$key = strtoupper($value);
                }
            }
            $empleado->fecha_expedicion_documento = date('Y-m-d', strtotime($empleado->fecha_expedicion_documento));
            $empleado->fecha_nacimiento = date('Y-m-d', strtotime($empleado->fecha_nacimiento));

            if ($request->file('soporte_documento')->isValid()) {
                $path = $request->file('soporte_documento')->store('empleados');
                $empleado->soporte_documento = $path;
            }
            $empleado->save();
            return Utils::responseJson(
                Response::HTTP_OK,
                'Empleado guardado correctamente',
                $empleado->toArray(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudo gurardar el empleado, intente nuevamente',
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::with('genero', 'documento', 'escolaridad')->find($id);
        return Utils::responseJson(
            Response::HTTP_OK,
            $empleado === null ? 'No hay empleados registrados' : 'Datos encontrados satisfactoriamente',
            $empleado !== null ? $empleado->toArray() : $empleado,
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpleadoRequest  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $empleado = Empleado::find($id);

        if ($empleado === null) {
            return Utils::responseJson(Response::HTTP_NOT_FOUND, 'No existe un registro con este ID', null,  Response::HTTP_OK);
        }
        $validate = Validator($request->all(), UpdateEmpleadoRequest::rules($id), UpdateEmpleadoRequest::menssages());
        if ($validate->fails()) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'Invalid Data',
                $validate->errors(),
                Response::HTTP_OK
            );
        }

        foreach ($empleado->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key !== 'email' && $key !== 'soporte_documento') {
                    $empleado[$key] = strtoupper($request->$key);
                }
            }
        }

        if ($request->file('soporte_documento') && $request->file('soporte_documento')->isValid()) {
            $file = Storage::get($empleado->soporte_documento);
            if ($file) {
                Storage::delete($empleado->soporte_documento);
            }
            $path = $request->file('soporte_documento')->store('empleados');
            $empleado->soporte_documento = $path;
        }

        $empleado->save();
        return Utils::responseJson(
            Response::HTTP_OK,
            'Empleado actualizado correctamente',
            $empleado->toArray(),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        if ($empleado === null) {
            return Utils::responseJson(Response::HTTP_NOT_FOUND, 'No existe un registro con este ID', null,  Response::HTTP_OK);
        }
        $file = Storage::get($empleado->soporte_documento);
        if ($file) {
            Storage::delete($empleado->soporte_documento);
        }
        $empleado->delete();
        return Utils::responseJson(Response::HTTP_OK, 'Eliminado corectamente', $empleado,  Response::HTTP_OK);
    }
}
