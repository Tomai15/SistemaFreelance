@include('layout.header')

<div class="container mt-5 mb-5">
    @if (!isset(session('usuario')->perfilDesarrollador))
        <div class="container">
            <div class="alert alert-success text-center">
                Aun no tiene un perfil como desarrollador.
                Cree uno para postularse a proyectos.
            </div>
        </div>
        <h1 class="mb-4">Cree su perfil</h1>
    @endif
    <form action="/crearPerfil" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribe tu apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Número de Teléfono -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Número de Teléfono</label>
            <input value="{{old('telefono')}}" type="tel" class="form-control" id="telefono" name="telefono" placeholder="Escribe tu número de teléfono" required>
            @error('telefono')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- CVU -->
        <div class="mb-3">
            <label for="cvu" class="form-label">CVU</label>
            <input value="{{old('cvu')}}" type="text" class="form-control" id="cvu" name="CBU" placeholder="Escribe tu CVU" required>
            @error('CBU')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción sobre ti</label>
            <textarea value="{{old('descripcion_sobre_mi')}}" class="form-control" id="descripcion" name="descripcion_sobre_mi" rows="3" placeholder="Cuéntanos sobre ti" required></textarea>
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para subir foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Subir foto de perfil</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lista desplegable -->
        <div class="mb-3">
            <label for="tecnologias" class="form-label">Selecciona las tecnologias que conoces</label>
            <select class="form-select" id="tecnologias" name="tecnologias[]" multiple required>
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

<script>
    // Referencias a los elementos del DOM
    const tecnologiasSelect = document.getElementById('tecnologias');
    const nivelesConocimientoDiv = document.getElementById('nivelesConocimiento');

    // Evento para detectar cambios en la selección de tecnologias
    tecnologiasSelect.addEventListener('change', () => {
        // Limpia el contenido previo
        nivelesConocimientoDiv.innerHTML = '';

        // Itera sobre las opciones seleccionadas
        Array.from(tecnologiasSelect.selectedOptions).forEach(option => {
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
