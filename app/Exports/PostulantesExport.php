<?php

namespace App\Exports;

use App\Models\Postulacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostulantesExport implements FromCollection, WithHeadings
{
    protected $proyectoId;
    protected $proyectoNombre;

    public function __construct($proyectoId)
    {
        $this->proyectoId = $proyectoId;

        $data = app()->call('App\Http\Controllers\ProyectoController@exportarPostulantesPorProyecto', ['proyectoId' => $this->proyectoId]);
        $this->proyectoNombre = $data['proyecto_nombre'];
    }

    public function collection()
    {
        $data = app()->call('App\Http\Controllers\ProyectoController@exportarPostulantesPorProyecto', ['proyectoId' => $this->proyectoId]);

        $flatData = collect();

        foreach ($data['postulantes'] as $postulante) {
            $flatData->push([
                'nombre' => $postulante['nombre'],
                'apellido' => $postulante['apellido'],
                'promedio_calificacion' => $postulante['promedio_calificacion'],
                'tecnologias' => implode(', ', $postulante['tecnologias']), // Concatenate tech data
            ]);
        }

        return $flatData;
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Promedio Calificación',
            'Tecnologías (Nivel)',
        ];
    }

    public function getProyectoNombre(): string
    {
        return $this->proyectoNombre;
    }
}
