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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propuestas = Propuesta::with('estados')->paginate(7);

        return Utils::responseJson(
            Response::HTTP_OK,
            $propuestas->count() === 0 ? 'No hay Propuestas registradas' : 'Datos encontrados satisfactoriamente',
            $propuestas,
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
     * @param  \App\Http\Requests\StorePropuestaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->tipo === 'PAE'){
            $validateInstitucion = Validator::make($request->institucion_id, StorePropuestaRequest::institucionRules(),StorePropuestaRequest::messageInstitucion());
            dd($validateInstitucion);

        }
        $validate = Validator::make($request->all(), StorePropuestaRequest::rules(), StorePropuestaRequest::menssages());
        if ($validate->fails() ) {
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
            dd($propuesta);


        } catch (Exception $e) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Propuesta $propuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Propuesta $propuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePropuestaRequest  $request
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropuestaRequest $request, Propuesta $propuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propuesta $propuesta)
    {
        //
    }
}
