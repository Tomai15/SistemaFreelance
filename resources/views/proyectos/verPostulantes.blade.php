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

    <a href="{{ route('export.postulantes', $proyecto->id) }}" class="btn btn-success">
        Descargar Listado de Postulantes
    </a>
    <div class="container py-4 m-4">
        <div class=" m-4 py-3">
            <div class="row">
                <div class="col-9">
                    <p class=" fw-bold">{{ $postulantes->count() }} freelancers estan postulados para esta
                        publicacion</p>
                </div>
                <div class="col-3 mb-4">
                    <h6 class="text-center ">
                        @if ($proyecto->estadoActual && $proyecto->estadoActual->estado->id === 1)
                            ACCIONES
                        @else
                            ESTADO
                        @endif
                    </h6>
                 </div>
                    </div>

                    <div class="row g-3 justify-content-center">
                        @if ($postulantes && $postulantes->count())
                            @foreach ($postulantes as $item)
                                @php
                                    $postulante = $item['perfil'];
                                    $postulacion = $item['postulacion'];
                                @endphp
                                <!-- Card del Postulante -->
                                <div class="col-9">
                                    <div class="card p-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($postulante->usuario->ruta_foto_usuario) }}"
                                                class="rounded-circle me-3" alt="Foto del Postulante" width="100"
                                                height="100">
                                            <div>
                                                <h5 class="card-title mb-1">
                                                    {{ $postulante->nombre . ' ' . $postulante->apellido }}</h5>
                                                <p class="card-text mb-1">{{ $postulante->descripcion_sobre_mi }}</p>
                                                <div class="row">
                                                    <div class="col-5 text-muted">Puntuación:
                                                        <strong>{{ $postulante->promedio_calificacion }}/5</strong>
                                                    </div>
                                                    <div class="col-7 text-muted">
                                                        @foreach ($postulante->tecnologiasConocidas as $tecnologiaConocida)
                                                            <span
                                                                class="badge bg-warning text-dark">{{ $tecnologiaConocida->tecnologia->nombre }}
                                                                ({{ $tecnologiaConocida->nivel_tecnologia }})
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class=" p-3  d-flex align-items-stretch">
                                        <div class="d-flex flex-column align-items-center justify-content-between "
                                            style="height: 100%;">

                                            @if ($proyecto->estadoActual && $proyecto->estadoActual->estado->id === 1)
                                                <div class=" w-100 text-center mb-3 mt-4" role="alert">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#elegirDesarrolladorModal{{ $postulante->id }}">
                                                        Elegir Desarrollador
                                                    </button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade"
                                                    id="elegirDesarrolladorModal{{ $postulante->id }}" tabindex="-1"
                                                    aria-labelledby="elegirDesarrolladorLabel{{ $postulante->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="elegirDesarrolladorLabel{{ $postulante->id }}">
                                                                    Confirmar
                                                                    Selección</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Está seguro de que desea seleccionar a este
                                                                desarrollador para
                                                                el
                                                                proyecto? Esta acción rechazará a los demás postulantes.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                <form
                                                                    action="{{ route('usuario.elegirDesarrollador', $postulacion->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Confirmar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info w-100 text-center mb-3 ms-5 mt-4" role="alert">
                                    {{ $postulacion->estado->nombre_estado }}
                                </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            @endif

        </div>
    </div>
</div>

</div>



@include('layout.footer')
