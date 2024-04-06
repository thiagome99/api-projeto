<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('produto',[ApiController::class, 'create_produto']);
Route::get('produto',[ApiController::class, 'read_produto_all']);
Route::get('produto/{id_produto}',[ApiController::class, 'read_produto_id']);
Route::post('produto/{id_produto}',[ApiController::class, 'update_produto']);
Route::delete('produto/{id_produto}',[ApiController::class, 'delete_produto']);

Route::post('categoria',[ApiController::class, 'create_categoria']);
Route::get('categoria',[ApiController::class, 'read_categoria_all']);
Route::get('categoria/{codigo_categoria}',[ApiController::class, 'read_categoria_codigo']);
Route::post('categoria/{codigo_categoria}',[ApiController::class, 'update_categoria']);
Route::delete('categoria/{codigo_categoria}',[ApiController::class, 'delete_categoria']);

Route::post('produto-categoria',[ApiController::class, 'create_produtocategoria']);
Route::get('produto-categoria',[ApiController::class, 'read_produtocategoria_all']);
Route::get('produto-categoria/{id_produto},{codigo_categoria}',[ApiController::class, 'read_produtocategoria_id']);
Route::post('produto-categoria/{id_produto},{codigo_categoria}',[ApiController::class, 'update_produtocategoria']);
Route::delete('produto-categoria/{id_produto},{codigo_categoria}',[ApiController::class, 'delete_produtocategoria']);
