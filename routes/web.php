<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/register','registrarUsuario');
    Route::post('login','logearUsuario');

});





Route::get('/proyectos', function () {
    return view('proyectos.indexHtmlPuro');
});