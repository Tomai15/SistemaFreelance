<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\PerfilDesarrollador;
use App\Models\Postulacion;
use App\Models\Urgencia;
use App\Models\Tecnologia;
use App\Models\Confidencialidad;
use App\Models\EstadoPorProyecto;
use App\Models\TecnologiaConocida;

class PopulateDatabaseSeeder extends Seeder
{
    /**
     * Corre el seed para la DB.
     */
    public function run(): void
    {
        // Seed Usuarios
        $this->seedUsuarios();

        // Seed PerfilesDesarrollador
        $this->seedPerfilesDesarrollador();

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
                "nombre_usuario" => "Juan",
                "password" => bcrypt("password1"),
            ],
            [
                "email" => "user2@example.com",
                "nombre_usuario" => "Ana",
                "password" => bcrypt("password2"),
            ],
            [
                "email" => "user3@example.com",
                "nombre_usuario" => "Carlos",
                "password" => bcrypt("password3"),
            ],
            [
                "email" => "user4@example.com",
                "nombre_usuario" => "user4",
                "password" => bcrypt("password4"),
            ],
            [
                "email" => "user5@example.com",
                "nombre_usuario" => "user5",
                "password" => bcrypt("password5"),
            ],
            [
                "email" => "user6@example.com",
                "nombre_usuario" => "user6",
                "password" => bcrypt("password6"),
            ],
        ];

        foreach ($users as $user) {
            Usuario::firstOrCreate(['email' => $user['email']], $user);
        }
    }

    /**
     * Seed PerfilesDesarrollador table.
     */
    private function seedPerfilesDesarrollador(): void
    {
        $perfiles = [
            [
                "nombre" => "Juan",
                "apellido" => "Pérez",
                "descripcion_sobre_mi" => "Desarrollador web con experiencia en tecnologías como HTML, CSS, y JavaScript. Apasionado por el diseño de interfaces intuitivas.",
                "promedio_calificacion" => 4.5,
                "id_usuario" => 1,
                "CBU" => "01700992 20000067797370",
                "telefono" => "+54 9 11 1234-5678",
            ],
            [
                "nombre" => "Ana",
                "apellido" => "García",
                "promedio_calificacion" => 4.8,
                "descripcion_sobre_mi" => "Ingeniera de software especializada en backend con Python y Django. Experta en desarrollo de APIs robustas.",
                "id_usuario" => 2,
                "CBU" => "28590992 20000067797370",
                "telefono" => "+54 9 223 123-4567",
                
            ],
            [
                "nombre" => "Carlos",
                "apellido" => "López",
                "descripcion_sobre_mi" => "Diseñador gráfico con experiencia en branding y diseño digital. Entusiasta del diseño UX/UI.",
                "promedio_calificacion" => 4.2,
                "id_usuario" => 3,
                "CBU" => "08790992 20000067435370",
                "telefono" => "+54 9 3541 12-3456",
            ],
            [
                "nombre" => "Pedro",
                "apellido" => "Giménez",
                "descripcion_sobre_mi" => "Diseñador gráfico con experiencia en branding y diseño digital. Entusiasta del diseño UX/UI.",
                "promedio_calificacion" => 4.2,
                "id_usuario" => 4,
                "CBU" => "27690992 20000067467812",
                "telefono" => "+54 9 3541 12-9726",
            ],
        ];

        foreach ($perfiles as $perfil) {
            PerfilDesarrollador::firstOrCreate(['id_usuario' => $perfil['id_usuario']], $perfil);
        }

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 2,
            'tecnologia_id' => 1,
            'nivel_tecnologia' => 10,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 2,
            'tecnologia_id' => 3,
            'nivel_tecnologia' => 6,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 1,
            'tecnologia_id' => 5,
            'nivel_tecnologia' => 5,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 1,
            'tecnologia_id' => 3,
            'nivel_tecnologia' => 8,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 4,
            'tecnologia_id' => 5,
            'nivel_tecnologia' => 4,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 4,
            'tecnologia_id' => 1,
            'nivel_tecnologia' => 10,
        ]);

        TecnologiaConocida::create([
            'perfil_desarrollador_id' => 4,
            'tecnologia_id' => 8,
            'nivel_tecnologia' => 7,
        ]);
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
                "nombre_proyecto" => "Desarrollo de Plataforma E-commerce",
                "descripcion" => "Se requiere el desarrollo de una plataforma de comercio electrónico completa, incluyendo carrito de compras, 
                pasarela de pagos, y gestión de inventario. El proyecto debe ser escalable y seguro, con una interfaz de usuario amigable y responsive.",
                "horas_estimadas" => 100,
                "precio" => 500,
                "urgencia_id" => 2,
                "confidencialidad_id" => 3,
                "usuario_id" => 3,
                "perfil_desarrollador_id" => 1,
                "tecnologias" => [2, 4, 5, 6],
            ],
            [
                "nombre_proyecto" => "Aplicación Móvil para Gestión de Tareas",
                "descripcion" => "Desarrollo de una aplicación móvil para la gestión de tareas personales y profesionales. La aplicación 
                debe permitir la creación, edición y eliminación de tareas, así como la asignación de prioridades y fechas de vencimiento. 
                Se valorará la integración con calendarios y notificaciones push.",
                "horas_estimadas" => 100,
                "precio" => 800,
                "urgencia_id" => 3,
                "confidencialidad_id" => 4,
                "usuario_id" => 3,
                "tecnologias" => [1, 3, 5],
            ],
            [
                "nombre_proyecto" => "Sistema de Reservas para Restaurantes",
                "descripcion" => "Necesitamos un sistema de reservas en línea para restaurantes que permita a los clientes hacer reservas, 
                ver menús y recibir confirmaciones por correo electrónico. El sistema debe ser fácil de usar tanto para los clientes como 
                para el personal del restaurante, y debe incluir una interfaz de administración para gestionar las reservas.",
                "horas_estimadas" => 200,
                "precio" => 450,
                "urgencia_id" => 1,
                "confidencialidad_id" => 1,
                "usuario_id" => 3,
                "perfil_desarrollador_id" => 3,
                "tecnologias" => [6, 7],
            ],
            [
                "nombre_proyecto" => "Sistema de Gestión de Inventarios",
                "descripcion" => "Desarrollo de un sistema de gestión de inventarios para pequeñas y medianas empresas. El sistema debe permitir la entrada y salida de productos, generación de reportes y alertas de stock bajo.",
                "horas_estimadas" => 150,
                "precio" => 600,
                "urgencia_id" => 2,
                "confidencialidad_id" => 2,
                "usuario_id" => 1,
                "tecnologias" => [2, 3, 5],
            ],
            [
                "nombre_proyecto" => "Plataforma de Aprendizaje en Línea",
                "descripcion" => "Creación de una plataforma de aprendizaje en línea que permita a los usuarios inscribirse en cursos, ver contenido multimedia y realizar evaluaciones. La plataforma debe ser intuitiva y soportar múltiples idiomas.",
                "horas_estimadas" => 200,
                "precio" => 1000,
                "urgencia_id" => 3,
                "confidencialidad_id" => 4,
                "usuario_id" => 1,
                "perfil_desarrollador_id" => 2,
                "tecnologias" => [1, 4, 6],
            ],
            [
                "nombre_proyecto" => "Aplicación de Seguimiento de Salud",
                "descripcion" => "Desarrollo de una aplicación móvil para el seguimiento de la salud personal. La aplicación debe permitir el registro de actividades físicas, alimentación y sueño, y proporcionar estadísticas y recomendaciones personalizadas.",
                "horas_estimadas" => 120,
                "precio" => 700,
                "urgencia_id" => 1,
                "confidencialidad_id" => 3,
                "usuario_id" => 3,
                "tecnologias" => [3, 5, 7],
            ],
            [
                "nombre_proyecto" => "Sistema de Gestión de Recursos Humanos",
                "descripcion" => "Implementación de un sistema de gestión de recursos humanos que permita la administración de empleados, control de asistencia, y generación de nóminas. El sistema debe ser seguro y fácil de usar.",
                "horas_estimadas" => 180,
                "precio" => 900,
                "urgencia_id" => 2,
                "confidencialidad_id" => 2,
                "usuario_id" => 4,
                "tecnologias" => [2, 4, 6],
            ],
            [
                "nombre_proyecto" => "Portal de Noticias",
                "descripcion" => "Desarrollo de un portal de noticias en línea que permita la publicación de artículos, comentarios de usuarios y gestión de anuncios publicitarios. El portal debe ser rápido y optimizado para motores de búsqueda.",
                "horas_estimadas" => 130,
                "precio" => 550,
                "urgencia_id" => 3,
                "confidencialidad_id" => 1,
                "usuario_id" => 5,
                "tecnologias" => [1, 3, 5],
            ],
            [
                "nombre_proyecto" => "Sistema de Gestión de Eventos",
                "descripcion" => "Desarrollo de un sistema de gestión de eventos que permita la creación y administración de eventos, registro de asistentes, y envío de recordatorios. El sistema debe ser fácil de usar y permitir la integración con redes sociales.",
                "horas_estimadas" => 140,
                "precio" => 650,
                "urgencia_id" => 2,
                "confidencialidad_id" => 3,
                "usuario_id" => 4,
                "tecnologias" => [1, 4, 6],
            ],
            [
                "nombre_proyecto" => "Aplicación de Finanzas Personales",
                "descripcion" => "Desarrollo de una aplicación móvil para la gestión de finanzas personales. La aplicación debe permitir el seguimiento de ingresos y gastos, la creación de presupuestos y la generación de reportes financieros.",
                "horas_estimadas" => 110,
                "precio" => 500,
                "urgencia_id" => 1,
                "confidencialidad_id" => 2,
                "usuario_id" => 4,
                "tecnologias" => [2, 3, 5],
            ],
            [
                "nombre_proyecto" => "Sistema de Gestión de Bibliotecas",
                "descripcion" => "Desarrollo de un sistema de gestión de bibliotecas que permita la administración de libros, préstamos y devoluciones. El sistema debe incluir una interfaz de búsqueda y la generación de reportes de inventario.",
                "horas_estimadas" => 160,
                "precio" => 750,
                "urgencia_id" => 3,
                "confidencialidad_id" => 4,
                "usuario_id" => 4,
                "tecnologias" => [1, 4, 7],
            ],
            [
                "nombre_proyecto" => "Plataforma de Reclutamiento",
                "descripcion" => "Creación de una plataforma de reclutamiento en línea que permita a las empresas publicar ofertas de trabajo y a los candidatos postularse. La plataforma debe incluir filtros de búsqueda y un sistema de gestión de aplicaciones.",
                "horas_estimadas" => 180,
                "precio" => 900,
                "urgencia_id" => 2,
                "confidencialidad_id" => 3,
                "usuario_id" => 4,
                "tecnologias" => [2, 5, 6],
            ],
            [
                "nombre_proyecto" => "Aplicación de Viajes y Turismo",
                "descripcion" => "Desarrollo de una aplicación móvil para la planificación de viajes y turismo. La aplicación debe permitir la búsqueda de destinos, la reserva de hoteles y actividades, y la creación de itinerarios personalizados.",
                "horas_estimadas" => 130,
                "precio" => 600,
                "urgencia_id" => 1,
                "confidencialidad_id" => 2,
                "usuario_id" => 4,
                "tecnologias" => [3, 4, 7],
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
    
            // Estado inicial 'Abierto' establecido pero en el pasado
            EstadoPorProyecto::create([
                'proyecto_id' => $project->id,
                'tipo_estado_id' => 1, 
                'created_at' => now()->subDays(3),
            ]);
    
            // Si el proyecto tiene un desarrollador se le pone estado 'En Curso'
            if ($project->perfil_desarrollador_id) {
                EstadoPorProyecto::create([
                    'proyecto_id' => $project->id,
                    'tipo_estado_id' => 2, 
                    'created_at' => now(), 
                ]);
            }
        }

        EstadoPorProyecto::create([
            'proyecto_id' => 1,
            'tipo_estado_id' => 3, 
            'created_at' => now(),
        ]);

        EstadoPorProyecto::create([
            'proyecto_id' => 3,
            'tipo_estado_id' => 3, 
            'created_at' => now(),
        ]);

        Postulacion::create([
            'proyecto_id' => 2,
            'perfil_desarrollador_id' => 2,
            'estado_postulacion_id' => 1,
        ]);
        Postulacion::create([
            'proyecto_id' => 4,
            'perfil_desarrollador_id' => 2,
            'estado_postulacion_id' => 3,
        ]);
        Postulacion::create([
            'proyecto_id' => 5,
            'perfil_desarrollador_id' => 2,
            'estado_postulacion_id' => 2,
        ]);
        Postulacion::create([
            'proyecto_id' => 2,
            'perfil_desarrollador_id' => 1,
            'estado_postulacion_id' => 1,
        ]);
    }
}
