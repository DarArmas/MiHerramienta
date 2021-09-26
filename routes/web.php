<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::post('catalogo', [CatalogoController::class, 'registrar'])->name('catalogo.registrar');
//Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index')->middleware('auth');
Route::get('catalogo/eliminar/{id}', [CatalogoController::class, 'eliminar'])->name('catalogo.eliminar');
Route::get('catalogo/editar/{id}', [CatalogoController::class, 'editar'])->name('catalogo.editar');
Route::post('catalogo/actualizar', [CatalogoController::class, 'actualizar'])->name('catalogo.actualizar');