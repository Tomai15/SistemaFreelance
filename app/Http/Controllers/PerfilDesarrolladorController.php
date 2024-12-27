<?php

namespace App\Http\Controllers;

use App\Models\PerfilDesarrollador;
use App\Models\Tecnologia;
use App\Models\TecnologiaConocida;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class PerfilDesarrolladorController extends Controller
{
    public function crearPerfil(Request $request)
    {       
        $tecnologias = Tecnologia::all();
        if(!isset(session('usuario')->perfilDesarrollador))
        {
            
            // compact('tecnologias') == ['tecnologias' => $tecnologias]
            return view('perfil.crearPerfil',compact('tecnologias'));  
        }
        return view('perfil.editarPerfil',compact('tecnologias'));
    }
    public function guardarPerfil(Request $request)
    {
        $datosUsuario = $request->validate
        (
            [
                "nombre" => ['string','required'],
                "apellido" => ['string','required'],
                "descripcion_sobre_mi" => ['string','required'],
                "foto" => ['required',File::image()],
                'tecnologias' => 'required|array',
                'tecnologias.*' => 'string',
                'nivel' => 'required|array',
                'nivel.*' => 'integer|min:1|max:10'
            ]
        );
        
        //Me guardo las tecnologias y sus respectivos niveles en dos arrays
        $stringsTecnologias = $datosUsuario['tecnologias'];
        $nivelesTecnolgias = $datosUsuario['nivel'];
        
        //Almaceno la nueva foto de perfil
        $rutaFoto = "storage/" . $datosUsuario['foto']->store('/fotosPerfil','public');

        $nuevasTecnologiasGuardar = [];
        //Borro del array de datos del usuario las tecnologias nivel y foto porque hay
        //que convertirlos en objetos

        unset($datosUsuario['tecnologias']);
        unset($datosUsuario['nivel']);
        unset($datosUsuario['foto']);
        
        //Me traigo el usaurio en sesion
        $usuarioEnSesion = session('usuario');

        //Le asigno al usuario su nueva foto ya almacenada
        $usuarioEnSesion->ruta_foto_usuario = $rutaFoto;

        //Le creo un nuevo perfil al usuario
        $nuevoPerfil = $usuarioEnSesion->perfilDesarrollador()->create($datosUsuario);

        //Con un for creo todos los objetos tecnologia Conocida y los agrego a una lista
        foreach($stringsTecnologias as $stringTecnologia)
        {
            $tecnologiaEncontrada = Tecnologia::firstWhere('nombre',$stringTecnologia);
            $nivelEnTecnologia = $nivelesTecnolgias[$stringTecnologia];
            $nuevaTecnologiaConocida = new TecnologiaConocida(['nivel_tecnologia' =>$nivelEnTecnologia]);
            $nuevaTecnologiaConocida->tecnologia()->associate($tecnologiaEncontrada);
            array_push($nuevasTecnologiasGuardar,$nuevaTecnologiaConocida);
        }

        //Al nuevo perfil le agrego las tecnologias
        $nuevoPerfil->tecnologiasConocidas()->saveMany($nuevasTecnologiasGuardar);
        
        //Guardo el cambio de foto de perfil en el usuario
        $usuarioEnSesion->save();
        $usuarioEnSesion->refresh();
        session()->forget('usuario');
        session(['usuario' => $usuarioEnSesion]);

        return response()->redirectTo("/proyectos");

    }
}
