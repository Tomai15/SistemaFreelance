<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function  mostrarRegistro(Request $request)
    {
        return view('auth.register');
    }
    public function registrarUsuario(Request $request)
    {
        $datosUsuario = $request->validate
        (
            [
                "email" => ['required','email'],
                "nombreUsuario" => ['required', 'min:3', 'max:8'],
                "password" => ['required']
            ],
            [
                "email.required" => "necesita un mail para registarse",
                "email.email" => "Escriba correctamente su mail",
                "username.required" => "Este campo es obligatorio",
                "username.min" => "Este campo necesita un minimo de 3 caracteres",
                "username.max" => "Este campo no puede pasar de tantos caracteres",
                "password.required" => "Este campo es obligatorio",
            ]
        );
        $datosUsuario["password"] = bcrypt($datosUsuario["password"]);
        $datosUsuario["nombre_usuario"] = $datosUsuario["nombreUsuario"];
        unset($datosUsuario["nombre_usuario"]);
        Usuario::create($datosUsuario);

    }
    public function  mostrarLogin(Request $request)
    {
        return view('auth.login');
    }

}
