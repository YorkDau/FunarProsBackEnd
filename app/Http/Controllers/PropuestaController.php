<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use App\Http\Requests\StorePropuestaRequest;
use App\Http\Requests\UpdatePropuestaRequest;
use App\Http\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PropuestaController extends Controller
{
    public function index()
    {
        $propuestas = Propuesta::with('estados', 'empresaBeneficiaria')->paginate(7);

        return Utils::responseJson(
            Response::HTTP_OK,
            $propuestas->count() === 0 ? 'No hay Propuestas registradas' : 'Datos encontrados satisfactoriamente',
            $propuestas,
            Response::HTTP_OK
        );
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), StorePropuestaRequest::rules($request), StorePropuestaRequest::menssages());
        if ($validate->fails()) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudó guardar la propuesta, intente nuevamente',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }



        try {
            DB::beginTransaction();
            $propuesta = new Propuesta($request->all());

            foreach ($propuesta->attributesToArray() as $key => $value) {
                $propuesta->$key = strtoupper($value);
            }
            $propuesta->fecha_inicial = date('Y-m-d', strtotime($propuesta->fecha_inicial));
            $propuesta->save();
            //dd($propuesta);


            $instituciones = [];


            Db::commit();
            return Utils::responseJson(
                Response::HTTP_OK,
                'Propuesta guardada correctamente',
                $propuesta->toArray(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            DB::rollBack();
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudo guardar la propuesta, intente nuevamente',
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show(Propuesta $propuesta)
    {
        //
    }
    public function edit(Propuesta $propuesta)
    {
        //
    }
    public function update(UpdatePropuestaRequest $request, Propuesta $propuesta)
    {
        //
    }
    public function destroy(Propuesta $propuesta)
    {
        //
    }
}
