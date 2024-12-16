<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/login',function()
{
    return view('auth.login');
});

Route::get('/proyectos', function () {
    return view('proyectos.indexHtmlPuro');
});