<?php

use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\DisciplinaController;
use Illuminate\Support\Facades\Route;

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

Route::get('', function () { return view('welcome'); })->name('index');

Route::resource('curso', CursoController::class);
Route::resource('componente', ComponenteController::class);
Route::resource('turma', TurmaController::class);
Route::resource('disciplina', DisciplinaController::class);
