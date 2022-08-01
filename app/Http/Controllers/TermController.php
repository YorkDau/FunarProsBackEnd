<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Http\Utils;
use Illuminate\Http\Response;

class TermController extends Controller
{
    public function departamentos()
    {
         $pais = Term::where('name','Colombia')->first();
         $departamentos = Term::where('term_id', $pais->id)->get();
         if($departamentos === null){
            return Utils::responseJson(Response::HTTP_NOT_FOUND,'No se encuentran departamentos registrados', null,  Response::HTTP_OK);
        }
        return Utils::responseJson(
            Response::HTTP_OK,
            $departamentos->count() === 0 ? 'No hay departamentos registrados' : 'Datos encontrados satisfactoriamente',
            $departamentos,
            Response::HTTP_OK
        );
    }
    public function municipios($id){
        $municipios = Term::where('term_id',$id)->get();
         if($municipios === null){
            return Utils::responseJson(Response::HTTP_NOT_FOUND,'No se encuentran municipios registrados', null,  Response::HTTP_OK);
        }
        return Utils::responseJson(
            Response::HTTP_OK,
            $municipios->count() === 0 ? 'No hay municipios  registrados' : 'Datos encontrados satisfactoriamente',
            $municipios,
            Response::HTTP_OK
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTermRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermRequest  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }
}
