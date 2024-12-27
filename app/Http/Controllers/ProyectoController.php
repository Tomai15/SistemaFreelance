<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Urgencia;
use App\Models\Tecnologia;
use Illuminate\Http\Request;
use App\Models\Confidencialidad;
use App\Http\Controllers\Controller;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proyecto::query();

        // Filter by Tecnologías
        if ($request->filled('tecnologias')) {
            $tecnologias = (array) $request->input('tecnologias');
            $query->whereHas('tecnologias', function ($q) use ($tecnologias) {
                $q->whereIn('nombre', $tecnologias); 
            });
        }

        // Filter by Precio
        if ($request->filled('precioDesde')) {
            $query->where('precio', '>=', $request->input('precioDesde'));
        }
        if ($request->filled('precioHasta')) {
            $query->where('precio', '<=', $request->input('precioHasta'));
        }

        // Filter by Horas Estimadas
        if ($request->filled('horasDesde')) {
            $query->where('horas_estimadas', '>=', $request->input('horasDesde'));
        }
        if ($request->filled('horasHasta')) {
            $query->where('horas_estimadas', '<=', $request->input('horasHasta'));
        }

        // Filter by Urgencia
        if ($request->filled('urgencia')) {
            $query->whereHas('urgenciaEstablecida', function ($q) use ($request) {
                $q->where('nivel_urgencia', $request->input('urgencia'));
            });
        }

        // Filter by Confidencialidad
        if ($request->filled('confidencialidad')) {
            $query->whereHas('confidencialidadEstablecida', function ($q) use ($request) {
                $q->where('nivel_confidencialidad', $request->input('confidencialidad'));
            });
        }
            
            $proyectos = $query->paginate(10);

            $parametros = [
                "proyectos" => $proyectos
            ];

            return view('proyectos.index', $parametros);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $urgencias = Urgencia::all();
        $confidencialidades = Confidencialidad::all();
        $tecnologias = Tecnologia::all(); 

        $parametros = [
            'urgencias' => $urgencias,
            'confidencialidades' => $confidencialidades,
            'tecnologias' => $tecnologias
        ];

        return view("proyectos.create", $parametros);
    }


    /**
     * Store a newly created resource in storage.
     * *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            "nombre_proyecto" => ["required"],
            "descripcion" => ["required"],
            "urgencia_id" => ["required"],
            'confidencialidad_id' => ["required"],
            'horas_estimadas' => ["required"],
            'precio' => ["required",'numeric'],
            'tecnologias' => ['required', 'array'],
        ], [
            "nombre_proyecto.required" => "Este campo es obligatorio!",
            "descripcion.required" => "Este campo es obligatorio!",
            "urgencia_id.required" => "Debe seleccionar una opcion del campo!"
        ]);

        try {
            $usuarioEnSesion = session("usuario");
            $nuevoProyecto = $usuarioEnSesion->proyectos()->create($datos);

            //$proyecto = Proyecto::create($datos);
            $nuevoProyecto->tecnologias()->attach($request->tecnologias);
            

            session()->flash('success', 'El proyecto se ha creado exitosamente.');

            return view('proyectos');
        } catch (\Exception $e) {
            //\Log::error('Error creating project: ' . $e->getMessage());
            
            session()->flash('error', 'Hubo un error al crear el proyecto.');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       /*  $proyecto = Proyecto::with(['tecnologias', 'urgenciaEstablecida', 'confidencialidadEstablecida'])->findOrFail($id);

        return view('proyectos.show', ['proyecto' => $proyecto]); */
        return view('proyectos.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
