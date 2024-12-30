@include('layout.header')

<div class="container mt-5 mb-3">
    <h2 class="mb-4">Gestión del Proyecto</h2>

    <!-- Información del Proyecto -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Proyecto: <span id="projectTitle">{{ $proyecto->nombre_proyecto }}</span></h5>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> <span id="projectDescription">{{ $proyecto->descripcion }}</span></p>
            <p><strong>Estado:</strong> <span id="projectStatus">{{ $proyecto->estadoActual->estado->nombre_tipo_estado }}</span></p>
            @if ($proyecto->desarrolladorSeleccionado)
                <p><strong>Desarrollador:</strong> {{ $proyecto->desarrolladorSeleccionado->nombre }} {{ $proyecto->desarrolladorSeleccionado->apellido }}</p>
            @else
                <p><strong>Desarrollador:</strong> No asignado</p>
            @endif
        </div>
    </div>

    <!-- Estado Inicial (En Curso) -->
    @if ($proyecto->estadoActual->estado->nombre_tipo_estado === 'En Curso')
        <div class="alert alert-info" role="alert">
            <strong>Esperando a que el Desarrollador cargue archivos...</strong>
        </div>
    @endif

    <!-- Descargar Archivo Final (Visible si Estado es 'Entregado') -->
    @if ($proyecto->estadoActual->estado->nombre_tipo_estado === 'Entregado')
        <div class="mb-4">
            <h5>Archivo Final Entregado</h5>
            <p>Descarga el archivo final del proyecto:</p>
            <a href="{{ route('proyectos.descargarArchivoFinal', $proyecto->id) }}" class="btn btn-primary">
                <i class="bi bi-download"></i> Descargar Archivo
            </a>
        </div>

        <!-- Control del Proyecto (Aceptar/Rechazar) -->
        <div class="mb-4">
            <h5>Control del Proyecto</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rateModal">
                <i class="bi bi-check"></i> Aceptar Entrega
            </button>
            <button type="submit" name="accion" value="rechazar" class="btn btn-danger">
                <i class="bi bi-x"></i> Rechazar Entrega
            </button>
        </div>

        <!-- Modal para Rating -->
        <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('proyectos.controlEntrega', $proyecto->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="rateModalLabel">Calificar el Desempeño del Desarrollador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div id="starRating" class="d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill text-muted star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <input type="hidden" id="calificacion" name="calificacion" value="0">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="accion" value="aceptar" class="btn btn-success">Aceptar Entrega</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Información de Pago -->
    @if ($proyecto->estadoActual->estado->nombre_tipo_estado === 'Pendiente Pago')
        <div class="card mb-4">
            <div class="card-header">
                <h5>Datos del Desarrollador</h5>
            </div>
            <div class="card-body">
                <p><strong>CBU:</strong> {{ $proyecto->desarrolladorSeleccionado->CBU }}</p>
                <p><strong>Teléfono:</strong> {{ $proyecto->desarrolladorSeleccionado->telefono }}</p>
            </div>
        </div>
    @endif

    <!-- Resumen del Proyecto (Visible if Estado is 'Cerrado') -->
    @if ($proyecto->estadoActual->estado->nombre_tipo_estado === 'Cerrado')
        <div class="card mb-4">
            <div class="card-header">
                <h5>Resumen del Proyecto</h5>
            </div>
            <div class="card-body">
                <p><strong>Nombre del Proyecto:</strong> {{ $proyecto->nombre_proyecto }}</p>
                <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
                <p><strong>Calificación del Desarrollador:</strong> {{ $proyecto->calificacion_trabajo }}</p>
                <p><strong>Fecha de Inicio:</strong> {{ $proyecto->fecha_inicio ?? 'N/A' }}</p>
                <p><strong>Fecha de Finalización:</strong> {{ $proyecto->fecha_finalizacion ?? 'N/A' }}</p>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('calificacion');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                stars.forEach(s => s.classList.add('text-muted'));
                for (let i = 0; i < value; i++) {
                    stars[i].classList.remove('text-muted');
                    stars[i].classList.add('text-warning');
                }
            });
        });
    });
</script>

@include('layout.footer')