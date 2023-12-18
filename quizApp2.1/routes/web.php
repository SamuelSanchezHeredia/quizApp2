<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RespuestasController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AliasController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::resource('preguntas', PreguntasController::class);
Route::resource('respuestas', RespuestasController::class);
Route::resource('historial', HistorialController::class);
Route::resource('admin', AdminController::class);
Route::resource('alias', AliasController::class);

Route::delete('/admin/preguntas/{id}/destroy', [AdminController::class, 'destroy'])->name('admin.preguntas.destroy');
Route::get('/admin/preguntas/{id}/edit', [AdminController::class, 'edit'])->name('admin.preguntas.edit');
Route::put('/admin/preguntas/{id}/update', [AdminController::class, 'update'])->name('admin.preguntas.update');

Route::post('/preguntas/resultados', [PreguntaController::class, 'store'])->name('resultados');
Route::post('guardar-nombre', [AliasController::class, 'guardarNombre'])->name('guardar-nombre');



