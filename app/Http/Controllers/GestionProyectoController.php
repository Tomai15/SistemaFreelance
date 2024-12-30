<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\EstadoPorProyecto;
use App\Models\TipoEstado;
use App\Models\PerfilDesarrollador;

class GestionProyectoController extends Controller
{
    public function show($id)
    {
        if(!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $proyecto = Proyecto::with(['estadoActual.estado', 'desarrolladorSeleccionado'])->findOrFail($id);
        return view('gestion.proyecto', compact('proyecto'));
    }

    
    public function controlEntrega(Request $request, $id)
    {
        $proyecto = Proyecto::with('desarrolladorSeleccionado')->findOrFail($id);

        if ($request->accion === 'rechazar') {
            
            $this->createEstado($proyecto, 'En Curso');
            return redirect()->back()->with('success', 'Entrega rechazada y estado actualizado a "En Curso".');
        }

        if ($request->accion === 'aceptar') {
            
            $request->validate([
                'calificacion' => 'required|integer|min:1|max:5',
            ]);

            $perfil = $proyecto->desarrolladorSeleccionado;

            if ($perfil) {
                $this->actualizarCalificacionDesarrollador($perfil, $request->calificacion);
            }

            $this->createEstado($proyecto, 'Pendiente Pago');
            return redirect()->back()->with('success', 'Entrega aceptada y estado actualizado a "Pendiente Pago".');
        }

        return redirect()->back()->with('error', 'Acción inválida.');
    }


    public function descargarArchivoFinal($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        if ($proyecto->archivo_final_url) {
            return response()->download(public_path($proyecto->archivo_final_url));
        }

        return redirect()->back()->with('error', 'El archivo final no está disponible para este proyecto.');
    }

   
    private function createEstado(Proyecto $proyecto, $estadoNombre)
    {
        $tipoEstado = TipoEstado::where('nombre_tipo_estado', $estadoNombre)->firstOrFail();

        EstadoPorProyecto::create([
            'proyecto_id' => $proyecto->id,
            'tipo_estado_id' => $tipoEstado->id,
        ]);
    }

    
    private function actualizarCalificacionDesarrollador(PerfilDesarrollador $perfil, $newCalificacion)
    {
        $proyectosCalificados = $perfil->trabajosRealizados()
            ->whereHas('estadoActual.estado', function ($query) {
                $query->whereIn('nombre_tipo_estado', ['Pendiente Pago', 'Cerrado']);
            })->pluck('calificacion_trabajo');

        $promedioCalificaciones = $proyectosCalificados->avg();

        $perfil->promedio_calificacion = $proyectosCalificados->isNotEmpty()
            ? ($promedioCalificaciones + $newCalificacion) / ($proyectosCalificados->count() + 1)
            : $newCalificacion;

        $perfil->save();
    }
}
