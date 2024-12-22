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
        $proyectos = Proyecto::all();

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

        //INSERT

        $proyecto = Proyecto::create($datos);
        //DB::insert("INSERT INTO proyectos (nombre_proyecto, descripcion) VALUES (?, ?)", [$request->nombre_proyecto, $request->descripcion]);

        //REDIRECCION
        //return redirect("/proyectos");
        return response()->redirectTo("/proyectos");
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
