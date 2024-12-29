<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\Postulacion;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function mostrarMisPublicaciones(Request $request)
    {
        if(!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $proyectos = session('usuario')->proyectos()->paginate(10);
        return view('perfil.mis-publicaciones',compact('proyectos'));
    }

    public function mostrarPostulantes(Proyecto $proyecto, Request $request)
    {
        if (!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $proyecto->load('estadoActual.estado');

        $postulaciones = $proyecto->postulaciones()
            ->with([
                'estado', 
                'perfilDesarrollador.tecnologiasConocidas.tecnologia'
            ])->get();


        $postulantes = $postulaciones->map(function ($postulacion) {
            return [
                'perfil' => $postulacion->perfilDesarrollador,
                'postulacion' => $postulacion,
            ];
        })->filter();

        return view('proyectos.verPostulantes', compact('postulantes', 'proyecto'));
    }

    public function elegirDesarrollador(Postulacion $postulacion)
    {
        $proyecto = $postulacion->proyecto;
        
        //Lo establece como aprobado
        $postulacion->update(['estado_postulacion_id' => 2]);

        //Rechaza todas las demas postulaciones presentes
        Postulacion::where('proyecto_id', $proyecto->id)
            ->where('id', '!=', $postulacion->id)
            ->update(['estado_postulacion_id' => 3]); // 3 = Rechazado

        //Establece el desarrollador elegido
        $proyecto->update([
            'perfil_desarrollador_id' => $postulacion->perfil_desarrollador_id,
        ]);

        //Se establece como que el proyecto está 'En Curso'
        $proyecto->estadosPorProyecto()->create([
            'tipo_estado_id' => 2,
        ]);

        return redirect()->back()->with('success', 'El desarrollador ha sido seleccionado exitosamente.');
    }
}
