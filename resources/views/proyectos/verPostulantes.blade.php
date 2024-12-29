@include('layout.header')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container-fluid">
    <a href="/misPublicaciones" class="btn btn-secondary mb-3">← Volver</a>
    
    <h2 class="mb-4">Postulantes</h2>
    
    <!-- Tabla de postulantes -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Calificación Promedio</th>
                    <th>Tecnologías Conocidas</th>
                    <th>
                        @if($proyecto->estadoActual && $proyecto->estadoActual->estado->id === 1)
                            ACCIONES
                        @else
                            ESTADO
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($postulantes && $postulantes->count())
                    @foreach($postulantes as $item)
                    @php
                        $postulante = $item['perfil'];
                        $postulacion = $item['postulacion'];
                    @endphp
                    <tr>
                        <td>{{ $postulante->nombre }}</td>
                        <td>{{ $postulante->apellido }}</td>
                        <td>{{ $postulante->promedio_calificacion }}</td>
                        <td>
                            @foreach($postulante->tecnologiasConocidas as $tecnologiaConocida)
                                <div>{{ $tecnologiaConocida->tecnologia->nombre }} ({{ $tecnologiaConocida->nivel_tecnologia }})</div>
                            @endforeach
                        </td>
                        <td>
                            @if($proyecto->estadoActual && $proyecto->estadoActual->estado->id === 1)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#elegirDesarrolladorModal{{ $postulante->id }}">
                                    Elegir Desarrollador
                                </button>
                    
                                <!-- Modal -->
                                <div class="modal fade" id="elegirDesarrolladorModal{{ $postulante->id }}" tabindex="-1" aria-labelledby="elegirDesarrolladorLabel{{ $postulante->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="elegirDesarrolladorLabel{{ $postulante->id }}">Confirmar Selección</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea seleccionar a este desarrollador para el proyecto? Esta acción rechazará a los demás postulantes.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('usuario.elegirDesarrollador', $postulacion->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td>{{ $postulacion->estado->nombre_estado }}</td>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">Nadie se ha postulado por el momento</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@include('layout.footer')
