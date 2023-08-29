<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\AuthController;
use App\Models\Despesa;
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


Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){

    // Rotas de Despesa
    Route::get('/despesas', [DespesaController::class, 'index']);
    Route::post('/despesas', [DespesaController::class, 'store']);
    Route::get('/despesas/{id}', [DespesaController::class, 'show']);
    Route::put('/despesas/{id}', [DespesaController::class, 'update']);
    Route::delete('/despesas/{id}', [DespesaController::class, 'destroy']);

    // Rotas de Logout 
    Route::post('/logout', [AuthController::class, 'logout']);

});

