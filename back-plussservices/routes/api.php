<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\RentasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Almacenar ordenes

    Route::apiResource('/categorias', CategoriaController::class);
    Route::apiResource('/libros', LibrosController::class);
    Route::post('/libros/filtrar',[LibrosController::class,'filtrar']);

    Route::get('/libros/revisarLocaldiad',[LibrosController::class,'revisarLocalidad']);

    Route::post('/libros/{libro}/rentar',[RentasController::class,'rentarLibro']);
    Route::post('/logout',[AuthController::class,'logout']);

});



//SIN Autenticacion
Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

