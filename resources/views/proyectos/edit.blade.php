@include('layout.header')

@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="successModalLabel">¡Éxito!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>El proyecto se ha actualizado exitosamente.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="/misPublicaciones" class="btn btn-primary">Continuar</a>
            </div>
        </div>
    </div>
</div>
@endif

{{--     @if(session('error'))
    <div class="alert alert-danger mx-5">
        {{ session('error') }}
    </div>
    @endif --}}

    <main class="">
        <div class="d-flex align-items-center text-gray">
            <div class="container m-5">
                <form action="/proyectos/{{$proyecto->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mx-5">
                        <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                        <input value="{{ old('nombre_proyecto', $proyecto->nombre_proyecto) }}" type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" autocomplete="off" aria-describedby="projectHelp">
                        <div id="projectHelp" class="form-text">Cuéntanos que necesitas hecho.</div>
                        @error('nombre_proyecto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="4" name="descripcion" autocomplete="off" aria-describedby="descripcionHelp">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                        <div id="descripcionHelp" class="form-text">Ingrese algunas viñetas o descripción completa. Cuanto más detallado, mejor.</div>
                        @error('descripcion')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="url_documento_requerimientos" class="form-label">Documento de Requerimientos</label>
                        @if($proyecto->url_documento_requerimientos)
                            <p><a href="{{ asset($proyecto->url_documento_requerimientos) }}" target="_blank">Ver documento actual</a></p>
                        @endif
                        <input class="form-control" type="file" id="url_documento_requerimientos" name="url_documento_requerimientos" accept=".pdf">
                        @error('url_documento_requerimientos')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-1 mx-5 mb-3">
                        <div class="col-md-4">
                            <label for="horas_estimadas" class="form-label">Horas Estimadas</label>
                            <input value="{{ old('horas_estimadas', $proyecto->horas_estimadas) }}" type="number" class="form-control" id="horasEstimadas" name="horas_estimadas" placeholder="hs">
                            @error('horas_estimadas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="urgencia" class="form-label">Nivel de Urgencia</label>
                             <select id="urgencia" class="form-select" name="urgencia_id">
                                <option value="" disabled {{ old('urgencia_id',$proyecto->urgencia_id) ? '' : 'selected' }}>Seleccione una opción</option>
                                @foreach($urgencias as $urgencia)
                                    <option value="{{ $urgencia->id }}" {{ old('urgencia_id') == $urgencia->id ? 'selected' : '' }}> 
                                        {{ $urgencia->nivel_urgencia }}
                                    </option>
                                @endforeach
                             
                            </select>
                            @error('urgencia_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="confidencialidad" class="form-label">Nivel de Confidencialidad</label>
                             <select id="confidencialidad" class="form-select" name="confidencialidad_id">
                                <option value="" disabled {{ old('confidencialidad_id', $proyecto->confidencialidad_id) ? '' : 'selected' }}>Seleccione una opción</option>
                                @foreach($confidencialidades as $confidencialidad)
                                    <option value="{{ $confidencialidad->id }}" {{ old('confidencialidad_id') == $confidencialidad->id ? 'selected' : '' }}> 
                                        {{ $confidencialidad->nivel_confidencialidad }}
                                    </option>
                                @endforeach
                             
                            </select>
                            @error('confidencialidad_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-1 mx-5 mb-3">
                        <div class="col-md-8 me-5">
                            <label for="tecnologias" class="form-label">Tecnologías de Preferencia</label>
                            <br>
                            <select id="tecnologias" class="form-select" name="tecnologias[]" multiple>
                                @foreach($tecnologias as $tecnologia)
                                    <option value="{{ $tecnologia->id }}"
                                        {{ in_array($tecnologia->id, $proyecto->tecnologias->pluck('id')->toArray()) ? 'selected' : (is_array(old('tecnologias')) && in_array($tecnologia->id, old('tecnologias')) ? 'selected' : '') }}>
                                        {{ $tecnologia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tecnologias')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 ">
                            <label for="precio" class="form-label">Precio</label>
                            <input value="{{ old('precio', $proyecto->precio) }}" type="text" class="form-control" id="precio" name="precio" placeholder="$">
                            @error('precio')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
        
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </main>

    <script>
        window.onload = function () {
            const modalElement = document.getElementById('successModal');
            if (modalElement) {
                const successModal = new bootstrap.Modal(modalElement, {});
                successModal.show();
            }
        };
    </script>


@include('layout.footer')