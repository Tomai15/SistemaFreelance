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
            <table class="table-container table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>ESTADO</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($postulaciones->count())
                        @foreach ($postulaciones as $postulacion)
                            <tr>
                                <td>{{ $postulacion->proyecto->nombre_proyecto }}</td>
                                <td>
                                    @foreach ($postulacion->proyecto->tecnologias as $tecnologia)
                                        {{ $tecnologia->nombre }},
                                    @endforeach
                                </td>
                                <td>{{ $postulacion->estado->nombre_estado }}</td>
                                <td>
                                    @if ($postulacion->estado->nombre_estado === 'Pendiente')
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePostulacionModal{{ $postulacion->id }}">
                                            Cancelar Postulación
                                        </button>
                                    
                                        <!-- Modal -->
                                        <div class="modal fade" id="deletePostulacionModal{{ $postulacion->id }}" tabindex="-1" aria-labelledby="deletePostulacionLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deletePostulacionLabel">Confirmar Cancelación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro de que desea cancelar esta postulación?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form method="POST" action="{{ route('postulacion.destroy', $postulacion->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Cancelar Postulación</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($postulacion->estado->nombre_estado === 'Aprobado')
                                        <span></span>
                                    @else
                                        <span></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No tienes postulaciones registradas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination-container">
                <div class="pagination d-flex justify-content-between align-items-center">
                    {{ $postulaciones->links() }}
                </div>
            </div>
        </div>
    
        <!-- Trabajando -->
        <div class="tab-pane fade" id="trabajando">
            <table class="table-container table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($trabajosEnProceso->count())
                        @foreach ($trabajosEnProceso as $trabajo)
                            <tr>
                                <td>{{ $trabajo->nombre_proyecto }}</td>
                                <td>
                                    @foreach ($trabajo->tecnologias as $tecnologia)
                                        {{ $tecnologia->nombre }},
                                    @endforeach
                                </td>
                                <td>
                                    <a href="misPostulaciones/{{$trabajo->id}}/accionarProyecto" class="btn btn-primary btn-sm">Ver Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No tienes trabajos en proceso.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination-container">
                <div class="pagination d-flex justify-content-between align-items-center">
                    {{ $trabajosEnProceso->links() }}
                </div>
            </div>
        </div>
    
        <!-- Finalizados -->
        <div class="tab-pane fade" id="finalizados">
            <table class="table-container table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TECNOLOGÍAS</th>
                        <th>FECHA DE FINALIZACIÓN</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($trabajosRealizados->count())
                        @foreach ($trabajosRealizados as $trabajo)
                            <tr>
                                <td>{{ $trabajo->nombre_proyecto }}</td>
                                <td>
                                    @foreach ($trabajo->tecnologias as $tecnologia)
                                        {{ $tecnologia->nombre }},
                                    @endforeach
                                </td>
                                <td>{{ $trabajo->estadoActual->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a class="btn btn-secondary btn-sm">Descargar Informe</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No tienes trabajos finalizados.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination-container">
                <div class="pagination d-flex justify-content-between align-items-center">
                    {{ $trabajosRealizados->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')