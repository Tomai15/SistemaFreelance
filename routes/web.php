<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilDesarrolladorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;

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
    Route::put('/editarPerfil/{perfilDesarrollador}','editarPerfil');
    Route::get('/misPostulaciones','mostrarMisPostulacion');
    Route::delete('/misPostulaciones/{postulacion}', 'eliminarPostulacion')->name('postulacion.destroy');
}
);

Route::controller(UsuarioController::class)->group(function(){
    Route::get('/misPublicaciones','mostrarMisPublicaciones');
    Route::get('/misPublicaciones/{proyecto}/postulantes','mostrarPostulantes');
}
);

Route::controller(ProyectoController::class)->group(function () {
    Route::get('/proyectos', 'index')->name('proyectos.index');
    Route::get('/proyectos/create', 'create')->name('proyectos.create');
    Route::post('/proyectos', 'store')->name('proyectos.store');
    Route::get('/proyectos/{id}', 'show');
    //Route::get('/proyectos/{id}/postulantes', 'show')->name('proyectos.show');
    Route::get('/proyecto/descargar/{id}','descargarArchivo')->name('proyecto.descargar');
});