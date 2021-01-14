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

Route::get('/verdestino', function () {
    return view('home');
})->middleware('auth');
Route::get('/verauto', function () {
    return view('home');
})->middleware('auth');
Route::get('/verasistenciaauto', function () {
    return view('home');
})->middleware('auth');
Route::get('/verrecinto', function () {
    return view('home');
})->middleware('auth');

Route::get('/salidas', function () {
    return view('home');
})->middleware('auth');

Route::get('/reporte', function () {
    return view('home');
})->middleware('auth');

Route::get('/registroautomovil', function () {
    return view('home');
})->middleware('auth');

Route::get('/salidaautomovil', function () {
    return view('home');
})->middleware('auth');

Route::get('/reportpersona', function () {
    return view('home');
})->middleware('auth');

Route::get('/reportautomovil', function () {
    return view('home');
})->middleware('auth');

Route::get('/oautomovil', function () {
    return view('home');
})->middleware('auth');

Route::get('/opersona', function () {
    return view('home');
})->middleware('auth');
Route::get('/historialci', function () {
    return view('home');
})->middleware('auth');
Route::get('/historialnombre', function () {
    return view('home');
})->middleware('auth');
Route::get('/historialplaca', function () {
    return view('home');
})->middleware('auth');

Route::get('/video', function () {
    return view('video');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::apiResource('/user',\App\Http\Controllers\UserController::class)->middleware('auth');
Route::apiResource('/persona',\App\Http\Controllers\PersonaController::class)->middleware('auth');
Route::get('/personaauto/{placa}',[\App\Http\Controllers\IngresoautoController::class,'personaauto'])->middleware('auth');
Route::get('/buscar/{id}/{tabla}',[\App\Http\Controllers\PersonaController::class,'buscar'])->middleware('auth');
Route::get('/buscarasistencia/{id}',[\App\Http\Controllers\AsistenciaController::class,'buscar'])->middleware('auth');
Route::get('/buscarasistenciaauto/{id}',[\App\Http\Controllers\IngresoautoController::class,'buscarauto'])->middleware('auth');
Route::get('/buscarplaca/{id}',[\App\Http\Controllers\AutoController::class,'buscar'])->middleware('auth');

Route::apiResource('/asistencia',\App\Http\Controllers\AsistenciaController::class)->middleware('auth');
Route::apiResource('/ingresoauto',\App\Http\Controllers\IngresoautoController::class)->middleware('auth');
Route::get('/asistencia/{d1}/{d2}',[\App\Http\Controllers\AsistenciaController::class,'date'])->middleware('auth');
Route::get('/asistencia2/{d1}/{d2}',[\App\Http\Controllers\AsistenciaController::class,'date2'])->middleware('auth');
Route::get('/asistencia3/{d1}/{d2}/{recinto}',[\App\Http\Controllers\AsistenciaController::class,'date3'])->middleware('auth');
Route::get('/asistencia4/{d1}/{d2}',[\App\Http\Controllers\AsistenciaController::class,'date4'])->middleware('auth');
Route::get('/ingresoauto/{d1}/{d2}',[\App\Http\Controllers\IngresoautoController::class,'date'])->middleware('auth');
Route::get('/ingresoauto2/{d1}/{d2}',[\App\Http\Controllers\IngresoautoController::class,'date2'])->middleware('auth');
Route::get('/ingresoauto3/{d1}/{d2}',[\App\Http\Controllers\IngresoautoController::class,'date3'])->middleware('auth');
Route::get('/ingresoauto4/{d1}/{d2}',[\App\Http\Controllers\IngresoautoController::class,'date4'])->middleware('auth');
Route::get('/destino/{d1}/{d2}',[\App\Http\Controllers\DestinoController::class,'date'])->middleware('auth');
Route::apiResource('/destino',\App\Http\Controllers\DestinoController::class)->middleware('auth');
Route::apiResource('/auto',\App\Http\Controllers\AutoController::class)->middleware('auth');
Route::apiResource('/recinto',\App\Http\Controllers\RecintoController::class)->middleware('auth');
Route::put('/pass/{id}',[App\Http\Controllers\UserController::class, 'pass'])->middleware('auth');
Route::get('/obs/{id}',[App\Http\Controllers\PersonaController::class, 'obs'])->middleware('auth');
Route::get('/quitar/{id}',[App\Http\Controllers\AsistenciaController::class, 'quitar'])->middleware('auth');
Route::get('/quitarauto/{id}',[App\Http\Controllers\IngresoautoController::class, 'quitar'])->middleware('auth');
Route::get('/isUser',[App\Http\Controllers\UserController::class, 'usuario'])->middleware('auth');
