<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::paginate(10);

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
        return view("proyectos.create");
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
        "descripcion" => ["required"]
    ], [
        "nombre_proyecto.required" => "Este campo es obligatorio!",
        "descripcion.required" => "Este campo es obligatorio!"
    ]);

    try {
        $proyecto = Proyecto::create($datos);

        session()->flash('success', 'El proyecto se ha creado exitosamente.');

        return view('proyectos.create');
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
        //
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
