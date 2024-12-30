<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilDesarrolladorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GestionProyectoController;
use App\Exports\PostulantesExport;
use Maatwebsite\Excel\Facades\Excel;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return redirect('/home');
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
    Route::get('/misPostulaciones/{proyecto}/accionarProyecto','accionarProyecto');
    Route::post('/misPostulaciones/{proyecto}/subirResultado','subirResultadoProyecto');
    Route::post('/misPostulaciones/{proyecto}/confirmarPago', 'confirmarPago')->name('misPostulaciones.confirmarPago');
    Route::delete('/misPostulaciones/{postulacion}', 'eliminarPostulacion')->name('postulacion.destroy');
}
);

Route::controller(UsuarioController::class)->group(function(){
    Route::get('/misPublicaciones','mostrarMisPublicaciones');
    Route::get('/misPublicaciones/{proyecto}/postulantes','mostrarPostulantes');
    Route::post('/elegir-desarrollador/{postulacion}', 'elegirDesarrollador')->name('usuario.elegirDesarrollador');
}
);

Route::controller(ProyectoController::class)->group(function () {
    Route::get('/proyectos', 'index')->name('proyectos.index');
    Route::get('/proyectos/create', 'create')->name('proyectos.create');
    Route::post('/proyectos', 'store')->name('proyectos.store');
    Route::get('/proyectos/{id}', 'show');
    //Route::get('/proyectos/{id}/postulantes', 'show')->name('proyectos.show');
    Route::get('/proyecto/descargar/{id}','descargarArchivo')->name('proyecto.descargar');
    Route::get('/proyectos/{id}/edit', 'edit')->name('proyectos.edit');
    Route::put('/proyectos/{id}', 'update')->name('proyectos.update');
    Route::delete('/proyectos/{id}', 'destroy')->name('proyectos.destroy');
    Route::post('/proyectos/{id}', 'postular')->name('proyectos.postular');   
});

Route::get('/proyectos/{proyectoId}/export-postulantes', function ($proyectoId) {

    $export = new PostulantesExport($proyectoId);

    $fileName = 'Postulantes_de_' . str_replace(' ', '_', $export->getProyectoNombre()) . '.xlsx';

    return Excel::download($export, $fileName);

})->name('export.postulantes');

Route::controller(GestionProyectoController::class)->group(function () {
    Route::get('/proyectos/{id}/gestion', 'show')->name('proyectos.gestion');
    Route::post('/proyectos/{id}/controlEntrega', 'controlEntrega')->name('proyectos.controlEntrega');
    Route::get('/proyectos/{id}/download', 'descargarArchivoFinal')->name('proyectos.descargarArchivoFinal');
});     