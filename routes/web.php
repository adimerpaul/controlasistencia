<?php

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

Route::get('/', function () {
    return view('login');
});

Route::get('/usuario', function () {
    return view('home');
})->middleware('auth');
Route::get('/verpersona', function () {
    return view('home');
})->middleware('auth');
Route::get('/verasistencia', function () {
    return view('home');
})->middleware('auth');
Route::get('/reporte', function () {
    return view('home');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::apiResource('/user',\App\Http\Controllers\UserController::class)->middleware('auth');
Route::apiResource('/persona',\App\Http\Controllers\PersonaController::class)->middleware('auth');
Route::put('/pass/{id}',[App\Http\Controllers\UserController::class, 'pass'])->middleware('auth');
