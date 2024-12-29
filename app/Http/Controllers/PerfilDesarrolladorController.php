<?php

namespace App\Http\Controllers;

use App\Models\PerfilDesarrollador;
use App\Models\Tecnologia;
use App\Models\TecnologiaConocida;
use App\Models\Postulacion;
use App\Models\Proyecto;
use Illuminate\Contracts\Cache\Store;
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

    public function editarPerfil(PerfilDesarrollador $perfilDesarrollador, Request $request)
    {
        $datosUsuario = $request->validate(
            [
                "nombre" => ['string', 'required'],
                "apellido" => ['string', 'required'],
                "descripcion_sobre_mi" => ['string', 'required'],
                "foto" => [File::image()],
                'tecnologias' => 'required|array',
                'tecnologias.*' => 'string',
                'nivel' => 'required|array',
                'nivel.*' => 'integer|min:1|max:10'
            ]
        );

        // Actualizamos datos básicos del perfil
        $perfilDesarrollador->nombre = $datosUsuario['nombre'];
        $perfilDesarrollador->apellido = $datosUsuario['apellido'];
        $perfilDesarrollador->descripcion_sobre_mi = $datosUsuario['descripcion_sobre_mi'];

        // Guardamos las tecnologías y niveles
        $stringsTecnologias = $datosUsuario['tecnologias'];
        $nivelesTecnologias = $datosUsuario['nivel'];

        // Obtener las tecnologías conocidas por el usuario
        $tecnologiasConocidas = $perfilDesarrollador->tecnologiasConocidas->keyBy(function ($tecnologiaConocida) {
            return $tecnologiaConocida->tecnologia->nombre;
        });

        $nuevasTecnologiasGuardar = [];

        foreach ($stringsTecnologias as $stringTecnologia) {
            $nivelEnTecnologia = $nivelesTecnologias[$stringTecnologia];

            if ($tecnologiasConocidas->has($stringTecnologia)) {
                // Si la tecnología ya es conocida, actualizamos su nivel
                $tecnologiaConocida = $tecnologiasConocidas[$stringTecnologia];
                $tecnologiaConocida->nivel_tecnologia = $nivelEnTecnologia;
                $tecnologiaConocida->save();
            } else {
                // Si la tecnología no es conocida, la agregamos
                $tecnologiaEncontrada = Tecnologia::firstWhere('nombre', $stringTecnologia);

                if ($tecnologiaEncontrada) {
                    $nuevaTecnologiaConocida = new TecnologiaConocida(['nivel_tecnologia' => $nivelEnTecnologia]);
                    $nuevaTecnologiaConocida->tecnologia()->associate($tecnologiaEncontrada);
                    array_push($nuevasTecnologiasGuardar, $nuevaTecnologiaConocida);
                }
            }
        }

        // Guardar las nuevas tecnologías conocidas
        $perfilDesarrollador->tecnologiasConocidas()->saveMany($nuevasTecnologiasGuardar);

        $usuarioEnSesion = session('usuario');
        // Guardar la nueva foto de perfil
        if(isset($datosUsuario['foto']))
        {
        $rutaFoto = "storage/" . $datosUsuario['foto']->store('/fotosPerfil', 'public');
        $usuarioEnSesion->ruta_foto_usuario = $rutaFoto; 
        }
        
        

        // Guardar el perfil actualizado
        $perfilDesarrollador->save();
        $usuarioEnSesion->save();
        session(('usuario'))->refresh();
        return response()->redirectTo("/proyectos");
    }

    public function mostrarMisPostulacion()
    {   

        if(!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $usuario = session('usuario');

        $perfilDesarrollador = $usuario->perfilDesarrollador;
        
        //redireccion por si no tiene perfil de desarrollador
        if (!$perfilDesarrollador) {
            return redirect('/crearPerfil')->with('error', 'Debe crear un perfil antes de ver sus postulaciones.');
        }

        $postulaciones = $perfilDesarrollador->postulaciones()->with(['proyecto', 'estado'])->paginate(10);

        $trabajosRealizados = $perfilDesarrollador->trabajosRealizados()
            ->whereHas('estadoActual.estado', function ($query) {
                $query->where('nombre_tipo_estado', 'Cerrado');
            })->paginate(10);

        $trabajosEnProceso = $perfilDesarrollador->trabajosEnProceso()
            ->whereHas('estadoActual.estado', function ($query) {
                $query->where('nombre_tipo_estado', 'En Curso');
            })->paginate(10);

        return view('perfil.mis-postulaciones', compact('postulaciones', 'trabajosRealizados', 'trabajosEnProceso'));
    }

    public function accionarProyecto(Proyecto $proyecto)
    {
        return view('perfil.accionarSobreProyecto',compact('proyecto'));
    }
    public function subirResultadoProyecto(Proyecto $proyecto,Request $request)
    {
        $datosUsuario = $request->validate
        (
            [
                "finalFile" => ['required']
            ]
        );

        $rutaArchivo = '/store' . $datosUsuario['finalFile']->store('/resultadosProyectos','public');

        $proyecto->url_documento_requerimientos = $rutaArchivo;
        $proyecto->save();
        $proyecto->refresh();
        return view('perfil.accionarSobreProyecto',compact('proyecto'));
    }

    public function eliminarPostulacion($id)
    {
        $postulacion = Postulacion::findOrFail($id);
        
        if ($postulacion->estado_postulacion_id !== 1) {
            return redirect()->back()->with('error', 'Acción denegada.');
        }

        
        $postulacion->delete();

        return redirect()->back()->with('success', 'La postulación fue cancelada exitosamente.');
    }


}
