<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Por Plata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/tablaProyectos.css')}}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="{{asset('imagensPresentacion/Logo.jpg')}}" class="navbar-brand logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                    @if (session()->has("success"))
                        <div class="container">
                            <div class="alert alert-success text-center">{{ session("success") }}</div>
                        </div>
                    @endif

                    @if (session()->has("fail"))
                        <div class="container">
                            <div class="alert alert-danger text-center">{{ session("fail") }}</div>
                        </div>
                    @endif
                    <div class="d-flex">
                        <a href="/login" class="btn btn-outline-primary me-2" type="button">Iniciar Sesión</a>
                        <a href="/register" class="btn btn-primary btn-register" type="button">Registrarse</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
