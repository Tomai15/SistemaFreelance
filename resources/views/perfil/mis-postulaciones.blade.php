@include('layout.header')
<div class="postulaciones container-fluid">

    <h2 class="mb-4 login">Mis Postulaciones</h2>

    <!-- Sección de navegación -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="postulaciones-tab" data-bs-toggle="tab" href="#postulaciones">Proyectos a los que me postulé</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="trabajando-tab" data-bs-toggle="tab" href="#trabajando">Proyectos en los que estoy trabajando</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="finalizados-tab" data-bs-toggle="tab" href="#finalizados">Proyectos finalizados</a>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content mt-4">
        <!-- Postulaciones -->
        <div class="tab-pane fade show active" id="postulaciones">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>ESTADO</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de proyecto -->
                    <tr>
                        <td>Proyecto A</td>
                        <td>HTML, CSS, JavaScript</td>
                        <td>Pendiente</td>
                        <td><button class="btn btn-danger btn-sm">Cancelar Postulación</button></td>
                    </tr>
                    <!-- Fin del ejemplo -->
                </tbody>
            </table>
        </div>

        <!-- Trabajando -->
        <div class="tab-pane fade" id="trabajando">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>PROGRESO</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de proyecto -->
                    <tr>
                        <td>Proyecto B</td>
                        <td>React, Node.js</td>
                        <td>50%</td>
                        <td><button class="btn btn-primary btn-sm">Ver Detalles</button></td>
                    </tr>
                        @if($postulaciones->count())
                        <!-- Filas repetidas para cada $postulacion -->
                            @foreach($postulaciones as $postulacion)
                            
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No hay proyectos disponibles por el momento</td>
                            </tr>
                        @endif
                    <!-- Fin del ejemplo -->
                </tbody>
            </table>
        </div>

        <!-- Finalizados -->
        <div class="tab-pane fade" id="finalizados">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>FECHA DE FINALIZACIÓN</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de proyecto -->
                    <tr>
                        <td>Proyecto C</td>
                        <td>Python, Flask</td>
                        <td>2024-12-01</td>
                        <td><button class="btn btn-secondary btn-sm">Descargar Informe</button></td>
                    </tr>
                    <!-- Fin del ejemplo -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layout.footer')