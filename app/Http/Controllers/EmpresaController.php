<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Http\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresas = Empresa::with('documentos', 'term.parent', 'tipos')->paginate(7);

        return Utils::responseJson(
            Response::HTTP_OK,
            $empresas->count() === 0 ? 'No hay empleados registrados' : 'Datos encontrados satisfactoriamente',
            $empresas,
            Response::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), StoreEmpresaRequest::rules(), StoreEmpresaRequest::menssages());
        if ($validate->fails()) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudó guardar la empresa, intente nuevamente',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
        try {
            DB::beginTransaction();
            $empresa = new Empresa($request->all());
            foreach ($empresa->attributesToArray() as $key => $value) {
                if ($key !== 'email') {
                    $empresa->$key = strtoupper($value);
                }
            }
            $empresa->fecha_convenio = date('Y-m-d', strtotime($empresa->fecha_convenio));

            $empresa->save();
            $documentos = [];
            foreach ($request->soportes as $key => $value) {
                if ($request->file("soportes.$key.file")) {
                    $path = $request->file("soportes.$key.file")->store('empresas/documentos');
                    $documentos[$value['document']['value']] = ['soporte_documento' => $path];
                }
            }

            $empresa->documentos()->sync($documentos);
            Db::commit();
            return Utils::responseJson(
                Response::HTTP_OK,
                'Empresa guardada correctamente',
                $empresa->toArray(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            DB::rollBack();
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'No se pudo gurardar la empresa, intente nuevamente',
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::with('term.parent','tipos')->find($id);
        return Utils::responseJson(
            Response::HTTP_OK,
            $empresa === null ? 'No hay empresas registrados' : 'Datos encontrados satisfactoriamente',
            $empresa !== null ? $empresa->toArray() : $empresa,
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpresaRequest  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $empresa = Empresa::find($id);
        if ($empresa === null) {
            return Utils::responseJson(Response::HTTP_NOT_FOUND, 'No existe un registro con este ID', null,  Response::HTTP_OK);
        }

        $validate = Validator($request->all(), UpdateEmpresaRequest::rules($id), UpdateEmpresaRequest::menssages());
        if ($validate->fails()) {
            return Utils::responseJson(
                Response::HTTP_BAD_REQUEST,
                'Invalid Data',
                $validate->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
        $empresa->fill($request->all());
        foreach ($empresa->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key !== 'email') {
                    $empresa[$key] = strtoupper($request->$key);
                }
            }
        }
        $empresa->fecha_convenio = date('Y-m-d', strtotime($empresa->fecha_convenio));
        /* [
            'documento -> 1'
            'documento -> 2'
            'documento -> 3'
        ] -> creando
        [
            'documento -> 1 iguales'
            'documento -> 2 -> actualizo',
            'documento -> 3 elimine (eliminar archivo)'
            'documneto -> 4  nuevo'
        ] ->actualizando case 1
        [
            'documento -> 1'
            'documento -> 2 -> eliminar y add (replace)'
            'documento -> 3',
            'documneto -> 4 -> add'
        ]->actualizando case 2

        */
        foreach ($empresa->documentos as $document) {
            ($document->pivot->soporte_documento);
        }

        //$empresa->save();
        $documentos = [];
        foreach ($empresa->documentos as $key => $value) {
        }
        $empresa->documentos()->sync($documentos);
        return Utils::responseJson(
            Response::HTTP_OK,
            'Empresa actualizada correctamente',
            $empresa->toArray(),
            Response::HTTP_OK
        );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if ($empresa === null) {
            return Utils::responseJson(Response::HTTP_NOT_FOUND, 'No existe un registro con este ID', null,  Response::HTTP_OK);
        }
        $empresa->delete();
        return Utils::responseJson(Response::HTTP_OK, 'Eliminado corectamente', $empresa,  Response::HTTP_OK);
    }
}
