<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MostrarPrenda;

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

Route::get('/articulo', [MostrarPrenda::class, 'index'])->name('mostrarArticulo');

Route::get('/articulo/{id}', [MostrarPrenda::class, 'verTiendaChein'])->name('verTiendaChein');

Route::post('/articulo', [MostrarPrenda::class, 'guardarTiendaChein'])->name('guardarTiendaChein');

Route::delete('/articulo/{id}', [MostrarPrenda::class, 'eliminarTiendaChein'])->name('eliminarTiendaChein');

Route::post('/articulo/{id}', [MostrarPrenda::class, 'actualizarTiendaChein'])->name('actualizarTiendaChein');
