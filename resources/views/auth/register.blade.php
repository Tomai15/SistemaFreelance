<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Íconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
</head>
<body>
    <!-- Contenedor Principal -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- Tarjeta de Login -->
        <div class="card shadow p-4">
            <!-- Imagen del Logo -->
            <div class="text-center mb-3">
                <img src="{{asset('imagensPresentacion/Logo.jpg')}}" alt="Logo" class="logo">
            </div>
            <h1 class="text-center mb-3">Registrese</h1>
            <!-- Formulario -->
            <form action="/register" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                    <input  name="nombreUsuario" class="form-control" placeholder="Nombre de usuario" required>
                </div>
                @error('nombreUsuario')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <!-- Campo de Email o Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input name= "email" type="email" class="form-control" placeholder="Mail" required>
                </div>
                @error('email')
                        <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <!-- Campo de Password -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input name ="password" type="password" class="form-control" placeholder="Contraseña" required>
                </div>
                 @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <!-- Recordarme y Olvidé mi contraseña -->
                <div class="d-flex justify-content-between mb-3">
                    <a href="/login" class="text-decoration-none">Ya tengo cuenta</a>
                </div>
                <!-- Botón de Login -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-bold">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
