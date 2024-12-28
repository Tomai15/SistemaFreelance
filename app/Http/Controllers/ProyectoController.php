<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Urgencia;
use App\Models\Tecnologia;
use Illuminate\Http\Request;
use App\Models\Confidencialidad;
use App\Http\Controllers\Controller;
use App\Models\EstadoPorProyecto;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proyecto::query();

        //Filtra todos aquellos cuyo ultimo estado es 'Abierto'
        $query->whereHas('estadoActual', function ($q) {
            $q->whereHas('estado', function ($q) {
                $q->where('nombre_tipo_estado', 'Abierto');
            });
        });

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
            'url_documento_requerimientos' => ['file','mimes:pdf','max:2048'], // Máx 2MB
            "urgencia_id" => ["required"],
            'confidencialidad_id' => ["required"],
            'horas_estimadas' => ["required"],
            'precio' => ["required",'numeric'],
            'tecnologias' => ['required', 'array'],
        ], [
            "nombre_proyecto.required" => "Este campo es obligatorio!",
            "descripcion.required" => "Este campo es obligatorio!",
            "url_documento_requerimientos.max" => "El archivo no debe exceder los 2 MB.",
            "urgencia_id.required" => "Debe seleccionar una opcion del campo!",
            "confidencialidad_id.required" => "Debe seleccionar una opcion del campo!",
            "horas_estimadas.required" => "Este campo es obligatorio!",
            "precio.required" => "Este campo es obligatorio!",
            "precio.numeric" => "Este campo debe ser numérico!",
            "tecnologias.required" => "Debe seleccionar una o varias opciones del campo!"
        ]);

        try {
            if ($request->hasFile('url_documento_requerimientos')) {
                // Guardar el archivo en el sistema de almacenamiento (storage/app/requerimientos)
                $fileName = str_replace(' ','',$datos['nombre_proyecto']);
                $path = "storage/" . $request->file('url_documento_requerimientos')->storeAs('/requerimientos',$fileName. '.' . $request->url_documento_requerimientos->extension() , 'public');
                $datos['url_documento_requerimientos']=$path;
            }
            
            $usuarioEnSesion = session("usuario");
            $nuevoProyecto = $usuarioEnSesion->proyectos()->create($datos);
           
            $nuevoProyecto->estadosPorProyecto()->create([
                'tipo_estado_id' => 1, // Estado inicial con ID 1
                'created_at' => now()->subDays(3)->subHours(3)
            ]);

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
        $proyecto = Proyecto::with(['tecnologias', 'urgenciaEstablecida', 'confidencialidadEstablecida'])->findOrFail($id);
       //$proyecto = Proyecto::with(['urgenciaEstablecida', 'confidencialidadEstablecida', 'tecnologias', 'estadoActual', 'tagsBusqueda'])->findOrFail($id);

        return view('proyectos.show', ['proyecto' => $proyecto]); 
        //return view('proyectos.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $proyecto = Proyecto::with(['urgenciaEstablecida', 'confidencialidadEstablecida', 'tecnologias'])->findOrFail($id);

        $urgencias = Urgencia::all();
        $confidencialidades = Confidencialidad::all();
        $tecnologias = Tecnologia::all(); 

        $parametros = [
            'proyecto' => $proyecto,
            'urgencias' => $urgencias,
            'confidencialidades' => $confidencialidades,
            'tecnologias' => $tecnologias
        ];

        return view("proyectos.edit", $parametros);
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

    public function descargarArchivo($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Verificar que el archivo exista
        if (!file_exists($proyecto->url_documento_requerimientos)) {
            abort(404, 'El archivo no existe.');
        }

        // Descargar el archivo
        return response()->download($proyecto->url_documento_requerimientos, basename($proyecto->url_documento_requerimientos));
    }
}

