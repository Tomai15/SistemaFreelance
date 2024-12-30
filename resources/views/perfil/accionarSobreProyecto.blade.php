@include('layout.header')
    <div class="container mt-5 mb-3">
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
        <div class="mb-4">
            <h5>Requerimientos del Proyecto</h5>
            <p>Descarga el archivo con los requerimientos del proyecto:</p>
            <a href="{{asset($proyecto->url_documento_requerimientos)}}" download class="btn btn-primary">
                <i class="bi bi-download"></i> Descargar Requerimientos
            </a>
        </div>
        
        @if ($proyecto->estadoActual->estado->nombre_tipo_estado == 'Entregado')
            <div class="alert alert-info">
                Usted ya ha subido su trabajo. Espere la respuesta del dueño del proyecto.
            </div>
        @elseif ($proyecto->estadoActual->estado->nombre_tipo_estado == 'Pendiente pago')
            <div>
                <h5>Confirmar Pago</h5>
                <p>Confirme que ha realizado el pago correspondiente para completar el proyecto:</p>
                <form action="/misPostulaciones/{{$proyecto->id}}/confirmarPago" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-cash"></i> Confirmar Pago
                    </button>
                </form>
            </div>
        @endif
    </div>

@include('layout.footer')
