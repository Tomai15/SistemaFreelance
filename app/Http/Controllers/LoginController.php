<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $datosUsuario["ruta_foto_usuario"] = 'fotosPerfil/fotoDefecto.jpg';
        unset($datosUsuario["nombreUsuario"]);
        Usuario::create($datosUsuario);
        return response()->redirectTo("/home")->with("successLogin","Se registro correctamente, inicie sesion");

    }
    public function  mostrarLogin(Request $request)
    {
        return view('auth.login');
    }
    public function logearUsuario(Request $request)
    {
        $datosLogin = $request->validate
        (
            [
                "email" => ['required',],
                "password" => ['required']
            ],
            [
                'email.required' => "Necesita un mail para iniciar sesion",
                'password' => "Necesita ingresar su contraseña para iniciar sesion"
            ]
        );
        $usuario = Usuario::where('email',$datosLogin['email'])->first();

        if(!isset($usuario) || !Hash::check($datosLogin['password'], $usuario->password))
        {
            return back()->withErrors(['login' => 'Las credenciales no son validas']);
        }

        Auth::login($usuario);
        session(['usuario'=> $usuario]);

        return response()->redirectTo('/proyectos');
    }
    public function logOutUsuario(Request $request)
    {
        Auth::logout();
        session()->forget('usuario');
        return response()->redirectTo('/home');
    }

}
