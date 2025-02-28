<?php

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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::post('refresh',  [App\Http\Controllers\AuthController::class, 'refresh']);
Route::post('me',  [App\Http\Controllers\AuthController::class, 'me']);
});

Route::get('teste', [App\Http\Controllers\FunctionsController::class, 'teste']);

Route::get('/programas', [App\Http\Controllers\ProgramasAquecimentoController::class, 'getAll'])->name('listarprogramas');
Route::post('/create', [App\Http\Controllers\ProgramasAquecimentoController::class, 'create'])->name('createprogramas');
Route::delete('/delete/{id}', [App\Http\Controllers\ProgramasAquecimentoController::class, 'delete'])->name('deleteprograma');
