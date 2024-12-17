<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h1 class="text-center mb-3">Inicie sesion</h1>
            <!-- Formulario -->
            <form>
                <!-- Campo de Email o Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" placeholder="Mail" required>
                </div>
                <!-- Campo de Password -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <!-- Recordarme y Olvidé mi contraseña -->
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <a href="#" class="text-decoration-none">Olvidaste tu contraseña?</a>
                </div>
                <!-- Botón de Login -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-bold">Iniciar sesion</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
