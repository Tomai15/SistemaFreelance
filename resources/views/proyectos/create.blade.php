@include('layout.header')

@if(session('success'))
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="successModalLabel">¡Éxito!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>El proyecto se ha creado exitosamente.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="/proyectos" class="btn btn-primary">Continuar</a>
            </div>
        </div>
    </div>
</div>
@endif

    @if(session('error'))
    <!-- Error Alert -->
    <div class="alert alert-danger mx-5">
        {{ session('error') }}
    </div>
    @endif

    <main class="">
        <div class="d-flex align-items-center text-gray">
            <div class="container m-5">
                <form action="/proyectos" method="post">
                    @csrf
                    <div class="mb-3 mx-5">
                        <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                        <input value="{{ old('nombre_proyecto') }}" type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" autocomplete="off" aria-describedby="projectHelp">
                        <div id="projectHelp" class="form-text">Cuéntanos que necesitas hecho.</div>
                        @error('nombre_proyecto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="4" name="descripcion" autocomplete="off" aria-describedby="descripcionHelp">{{ old('descripcion') }}</textarea>
                        <div id="descripcionHelp" class="form-text">Ingrese algunas viñetas o descripción completa. Cuanto más detallado, mejor.</div>
                        @error('descripcion')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="formFile" class="form-label">Documento de Requerimientos</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="row g-1 mx-5 mb-3">
                        <div class="col-md-6">
                            <label for="horas_estimadas" class="form-label">Horas Estimadas</label>
                            <input type="number" class="form-control" id="horasEstimadas" placeholder="hs">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Nivel de Urgencia</label>
                            <select id="inputState" class="form-select" name="nivel_urgencia">
                                <option selected>Choose...</option>
                                <option>Alto</option>
                                <option>Medio</option>
                                <option>Bajo</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="precio" placeholder="$">
                        </div>
                    </div>

                    <div class="row g-1 mx-5 mb-3">
                        <div class="col-md-12">
                            <label for="horas_estimadas" class="form-label">Tecnologías de Preferencia</label>
                        </div>
                        <div class="col-md-12">
                            <!-- Technology Checkboxes -->
                            @php
                                $tecnologias = ['PHP', 'Java', 'Javascript', 'Kotlin', 'Laravel', 'React', 'Angular', 'Blade', 'Bootstrap', 'Vue'];
                            @endphp
                            @foreach ($tecnologias as $tecnologia)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="checkbox{{ $tecnologia }}" value="{{ $tecnologia }}" name="tecnologias[]">
                                    <label class="form-check-label" for="checkbox{{ $tecnologia }}">{{ $tecnologia }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Show Success Modal on Page Load -->
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