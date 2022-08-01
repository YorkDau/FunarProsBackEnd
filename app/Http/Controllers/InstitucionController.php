<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Http\Requests\StoreInstitucionRequest;
use App\Http\Resources\InstitucionResource;
use App\Http\Utils;
use Dflydev\DotAccessData\Util;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$instituciones = InstitucionResource::collection(Institucion::paginate(2));
        $instituciones = Institucion::with('term.parent')->paginate(6);
        return Utils::responseJson(
            Response::HTTP_OK,
            $instituciones->count() === 0 ? 'No hay instituciones registradas' : 'Datos encontrados satisfactoriamente',
            $instituciones,
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
     * @param  \App\Http\Requests\StoreInstitucionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), StoreInstitucionRequest::rules(), StoreInstitucionRequest::menssages());

        if ($validate->fails()) {
                return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudo guardar la institución intente nuevamente',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $institucion = new Institucion($request->all());
            foreach ($institucion->attributesToArray() as $key => $value) {
                if ($key !== 'email')
                    $institucion->$key = strtoupper($value);
            }
            $institucion->inicio_convenio= date('Y-m-d',strtotime($institucion->inicio_convenio));
            $institucion->save();
            return Utils::responseJson(Response::HTTP_CREATED, 'Institución guardada correctamente',
             $institucion->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return Utils::responseJson(Response::HTTP_BAD_REQUEST, 'No se pudo guardar la institución intente nuevamente',
             $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instituciones = Institucion::find($id);

        return Utils::responseJson(
            Response::HTTP_OK,
            $instituciones === null ? 'No hay instituciones registradas' : 'Datos encontrados satisfactoriamente',
            $instituciones !== null ? $instituciones->toArray() : $instituciones,
            Response::HTTP_OK
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Institucion $institucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstitucionRequest  $request
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $institucion = Institucion::find($id);
        if($institucion === null){
            return Utils::responseJson(Response::HTTP_NOT_FOUND,'No existe un registro con este ID', null,  Response::HTTP_OK);
        }

        $validate = Validator::make($request->all(), [
            'identificacion'=> 'required|unique:institucions,identificacion,'.$id,
            'telefono'=>'required',
            'nombre'=>'required',
            'email'=>'max:100|email',
            'inicio_convenio'=>'required|date',
            'tipo'=>'required'
        ], StoreInstitucionRequest::menssages());

         if ($validate->fails()) {

                return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'Invalid Data',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );

        }
        foreach ($institucion->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key == 'email') {
                    $institucion->$key = $request->$key;
                } else {
                    $institucion->$key = strtoupper($request->$key);
                }
            }
        }

        $institucion->save();
        return Utils::responseJson(Response::HTTP_OK,'Institución actualizada correctamente', $institucion,Response::HTTP_OK );

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institucion = Institucion::find($id);

        if($institucion === null){
            return Utils::responseJson(Response::HTTP_NOT_FOUND,'No existe un registro con este ID', null,  Response::HTTP_OK);
        }
        $institucion->delete();
        return Utils::responseJson(Response::HTTP_OK,'Eliminado corectamente', $institucion,  Response::HTTP_OK);
    }
}
