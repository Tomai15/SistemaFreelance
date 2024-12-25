@include('layout.header')

<div class="container mt-5 mb-5">
    <h1 class="mb-4">Cree su perfil</h1>
    <form>
        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
        </div>

        <!-- Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribe tu apellido" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción sobre ti</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Cuéntanos sobre ti" required></textarea>
        </div>

        <!-- Lista desplegable -->
        <div class="mb-3">
            <label for="habilidades" class="form-label">Selecciona las tecnologias que conoces</label>
            <select class="form-select" id="habilidades" name="habilidades[]" multiple required>
                @forEach($tecnologias as $tecnologia)
                    <option value="{{$tecnologia->nombre}}">{{$tecnologia->nombre}}</option>
                @endforEach
            </select>
            <small class="form-text text-muted">Selecciona varias opciones presionando Ctrl o Cmd.</small>
        </div>

        <!-- Niveles de conocimiento -->
        <div id="nivelesConocimiento" class="mb-3">
            <label class="form-label">Nivel de conocimiento por habilidad</label>
            <!-- Los niveles se generarán dinámicamente aquí -->
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Referencias a los elementos del DOM
    const habilidadesSelect = document.getElementById('habilidades');
    const nivelesConocimientoDiv = document.getElementById('nivelesConocimiento');

    // Evento para detectar cambios en la selección de habilidades
    habilidadesSelect.addEventListener('change', () => {
        // Limpia el contenido previo
        nivelesConocimientoDiv.innerHTML = '';

        // Itera sobre las opciones seleccionadas
        Array.from(habilidadesSelect.selectedOptions).forEach(option => {
            const habilidad = option.value;

            // Crea una fila para la habilidad y su nivel
            const fila = document.createElement('div');
            fila.className = 'row mb-2 align-items-center';

            fila.innerHTML = `
                <div class="col-6">
                    <label class="form-label">${habilidad}</label>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" name="nivel[${habilidad}]" placeholder="Nivel (1-10)" min="1" max="10" required>
                </div>
            `;

            // Agrega la fila al contenedor de niveles
            nivelesConocimientoDiv.appendChild(fila);
        });
    });
</script>


@include('layout.footer')