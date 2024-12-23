<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.index');
});

Route::controller(LoginController::class)->group(function() 
{
    Route::get('/register','mostrarRegistro');
    Route::get('/login','mostrarLogin');
    Route::get('/logout','logOutUsuario');
    Route::post('/register','registrarUsuario');
    Route::post('login','logearUsuario');

});





// Route::get('/proyectos', function () {
//     return view('proyectos.index');
// });

Route::get('/proyectos', [ProyectoController::class, 'index']);
Route::get('/proyectos/create', [ProyectoController::class, 'create']);
Route::post('/proyectos', [ProyectoController::class, 'store']);