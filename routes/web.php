<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\ProgramasAquecimentoController::class, 'getAll'])->name('welcome');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('index');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'Login'])->name('login');
Route::post('/cadastrar', [App\Http\Controllers\LoginController::class, 'CreateUser'])->name('create.user');
