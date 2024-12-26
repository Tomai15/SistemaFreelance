<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilDesarrolladorController;
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

Route::controller(PerfilDesarrolladorController::class)->group(function()
{
    Route::get('/crearPerfil','crearPerfil');
    Route::post('/crearPerfil','guardarPerfil');
}
);

Route::controller(ProyectoController::class)->group(function () {
    Route::get('/proyectos', 'index')->name('proyectos.index');
    Route::get('/proyectos/create', 'create')->name('proyectos.create');
    Route::post('/proyectos', 'store')->name('proyectos.store');
    Route::get('/proyectos/{id}', 'show')->name('proyectos.show');
});