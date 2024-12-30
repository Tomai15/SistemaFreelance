@include('layout.header')
    <div class="container mt-5 mb-3">
        <a href="/misPostulaciones" class="btn btn-secondary mb-3">← Volver</a>
        <h2 class="mb-4">Gestión del Proyecto</h2>

        <!-- Información del Proyecto -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Proyecto: <span id="projectTitle">{{$proyecto->nombre_proyecto}}</span></h5>
            </div>
            <div class="card-body">
                <p><strong>Descripción:</strong> <span id="projectDescription">{{$proyecto->descripcion}}</span></p>
                <p><strong>Estado:</strong> <span id="projectStatus">{{$proyecto->estadoActual->estado->nombre_tipo_estado}}</span></p>
            </div>
        </div>

        <!-- Descargar Requerimientos -->
        @if (strcasecmp(trim($proyecto->estadoActual->estado->nombre_tipo_estado), 'Pendiente Pago') !== 0)    
            <div class="mb-4">
                <h5>Requerimientos del Proyecto</h5>
                <p>Descarga el archivo con los requerimientos del proyecto:</p>
                <a href="{{asset($proyecto->url_documento_requerimientos)}}" download class="btn btn-primary">
                    <i class="bi bi-download"></i> Descargar Requerimientos
                </a>
            </div>
        @endif
        
        @if (strcasecmp(trim($proyecto->estadoActual->estado->nombre_tipo_estado), 'Entregado') === 0)
            <div class="alert alert-info">
                Usted ya ha subido su trabajo. Espere la respuesta del dueño del proyecto.
            </div>
        @elseif (strcasecmp(trim($proyecto->estadoActual->estado->nombre_tipo_estado), 'Pendiente Pago') === 0)
            <div>
                <h5>Confirmar Pago</h5>
                <p>Confirme que ha realizado el pago correspondiente para completar el proyecto:</p>
                <form action="{{ route('misPostulaciones.confirmarPago', $proyecto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-cash"></i> Confirmar
                    </button>
                </form>
            </div>
        @else
        <!-- Subir Archivo Final -->
        <div>
            <h5>Subir Archivo Final</h5>
            <p>Sube el archivo final del proyecto cuando esté completado:</p>
            <form action="/misPostulaciones/{{$proyecto->id}}/subirResultado" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="finalFile" class="form-label">Selecciona un archivo:</label>
                    <input type="file" class="form-control" id="finalFile" name="finalFile" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-upload"></i> Subir Archivo
                </button>
            </form>
        </div>
        @endforelse
    </div>

@include('layout.footer')
