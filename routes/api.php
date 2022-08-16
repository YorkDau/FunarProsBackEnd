<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\TermController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('institucion',InstitucionController::class);

//Routes - Institucion
Route::get('/institucion', [InstitucionController::class, 'index']);
Route::post('/institucion', [InstitucionController::class, 'store']);
Route::get('/institucion/show/{id}', [InstitucionController::class, 'show']);
Route::put('/institucion/update/{id}', [InstitucionController::class, 'update']);
Route::delete('/institucion/delete/{id}', [InstitucionController::class, 'destroy']);

// Routes - Terms
Route::get('/term/departamentos', [TermController::class, 'departamentos']);
Route::get('/term/municipios/{id}', [TermController::class, 'municipios']);
Route::get('/term/documentos', [TermController::class, 'tipoDocumentos']);
Route::get('/term/niveles-estudios', [TermController::class, 'nivelEstudio']);
Route::get('/term/generos', [TermController::class, 'genero']);
Route::get('/term/tipos',[TermController::class,'tipoEmpresa']);
Route::get('/term/tipos-documentos-empresas',[TermController::class,'documentoEmpresa']);


//Routes - Empleados
Route::get('/empleados', [EmpleadoController::class, 'index']);
Route::post('/empleados', [EmpleadoController::class, 'store']);
Route::get('/empleados/show/{id}', [EmpleadoController::class, 'show']);
Route::put('/empleados/update/{id}', [EmpleadoController::class, 'update']);
Route::delete('/empleados/delete/{id}', [EmpleadoController::class, 'destroy']);

//Routes - Empresas
Route::get('/empresas', [EmpresaController::class, 'index']);
Route::post('/empresas', [EmpresaController::class, 'store']);
Route::get('/empresas/show/{id}', [EmpresaController::class, 'show']);
Route::put('/empresas/update/{id}', [EmpresaController::class, 'update']);
Route::delete('/empresas/delete/{id}', [EmpresaController::class, 'destroy']);

//Routes - Propuestas

Route::get('/propuestas', [PropuestaController::class, 'index']);
Route::post('propuestas', [PropuestaController::class, 'store']);
Route::get('/propuestas/show/{id}', [PropuestaController::class, 'show']);
Route::put('/propuestas/update/{id}', [PropuestaController::class, 'update']);
Route::delete('/propuestas/delete/{id}', [PropuestaController::class, 'destroy']);
