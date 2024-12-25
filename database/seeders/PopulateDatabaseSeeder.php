<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Urgencia;
use App\Models\Tecnologia;
use App\Models\Confidencialidad;

class PopulateDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Usuarios
        $this->seedUsuarios();

        // Seed Proyectos
        $this->seedProyectos();
    }

    /**
     * Seed Usuarios table.
     */
    private function seedUsuarios(): void
    {
        $users = [
            [
                "email" => "user1@example.com",
                "nombre_usuario" => "user1",
                "password" => bcrypt("password1"),
            ],
            [
                "email" => "user2@example.com",
                "nombre_usuario" => "user2",
                "password" => bcrypt("password2"),
            ],
            [
                "email" => "user3@example.com",
                "nombre_usuario" => "user3",
                "password" => bcrypt("password3"),
            ],
        ];

        foreach ($users as $user) {
            Usuario::firstOrCreate(['email' => $user['email']], $user);
        }
    }

    /**
     * Seed Proyectos table.
     */
    private function seedProyectos(): void
    {   
        $usuarios = \App\Models\Usuario::pluck('id')->toArray();
        if (empty($usuarios)) {
            $this->error("No se han encontrado usuarios.");
            return;
        }

        $tecnologias = \App\Models\Tecnologia::pluck('id')->toArray();
        if (empty($tecnologias)) {
            $this->command->error("No se han encontrado tecnologías.");
            return;
        }

        $projects = [
            [
                "nombre_proyecto" => "Proyecto A",
                "descripcion" => "Descripcion para el Proyecto A",
                "horas_estimadas" => 100,
                "precio" => 500,
                "urgencia_id" => 2,
                "confidencialidad_id" => 3,
                "usuario_id" => $usuarios[array_rand($usuarios)],
                "tecnologias" => [2, 4, 5, 6],
            ],
            [
                "nombre_proyecto" => "Proyecto B",
                "descripcion" => "Descripcion para el Proyecto B",
                "horas_estimadas" => 100,
                "precio" => 800,
                "urgencia_id" => 3,
                "confidencialidad_id" => 4,
                "usuario_id" => $usuarios[array_rand($usuarios)],
                "tecnologias" => [1, 3, 5],
            ],
            [
                "nombre_proyecto" => "Proyecto C",
                "descripcion" => "Descripcion para el Proyecto C",
                "horas_estimadas" => 200,
                "precio" => 450,
                "urgencia_id" => 1,
                "confidencialidad_id" => 1,
                "usuario_id" => $usuarios[array_rand($usuarios)],
                "tecnologias" => [6, 7],
            ],
        ];

        foreach ($projects as $projectData) {
            $tecnologiasForProject = $projectData['tecnologias'];
            unset($projectData['tecnologias']);

            $project = Proyecto::firstOrCreate(
                ['nombre_proyecto' => $projectData['nombre_proyecto']],
                $projectData
            );

            $project->tecnologias()->sync($tecnologiasForProject);
        }
    }
}
