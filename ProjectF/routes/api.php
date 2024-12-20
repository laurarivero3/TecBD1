<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroAutorController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\LibroEditorialController;
use App\Http\Controllers\EstadoPrestamoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\DetallePrestamoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\SancionController;
use App\Http\Controllers\HistorialLecturaController;

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

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('libros', LibroController::class);
Route::apiResource('autores', AutorController::class);
Route::apiResource('editoriales', EditorialController::class);
Route::apiResource('prestamos', PrestamoController::class);
Route::apiResource('detalle-prestamos', DetallePrestamoController::class);
Route::apiResource('likes', LikeController::class);
Route::apiResource('comentarios', ComentarioController::class);
Route::apiResource('archivos', ArchivoController::class);
Route::apiResource('sanciones', SancionController::class);
