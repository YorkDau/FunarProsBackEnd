<?php

use App\Http\Controllers\InstitucionController;
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
Route::get('/institucion',[InstitucionController::class,'index']);
Route::post('/institucion',[InstitucionController::class,'store']);
Route::get('/institucion/show/{id}',[InstitucionController::class,'show']);
Route::put('/institucion/update/{id}',[InstitucionController::class,'update']);
Route::delete('/institucion/delete/{id}',[InstitucionController::class,'destroy']);

// Routes-Terms
Route::get('/term/departamentos',[TermController::class,'departamentos']);
Route::get('/term/municipios/{id}',[TermController::class,'municipios']);