@include('layout.header')

<div class="container mt-5 mb-5">
        <h1 class="mb-4">Edite su perfil</h1>
        <form action="/editarPerfil/{{session('usuario')->perfilDesarrollador->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input value="{{old('nombre',session('usuario')->perfilDesarrollador->nombre)}}" type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
                @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input value="{{old('apellido',session('usuario')->perfilDesarrollador->apellido)}}" type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribe tu apellido" required>
                @error('apellido')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción sobre ti</label>
                <textarea class="form-control" id="descripcion_sobre_mi" name="descripcion_sobre_mi" rows="3" placeholder="Cuéntanos sobre ti" required>
                    {{old('descripcion_sobre_mi',session('usuario')->perfilDesarrollador->descripcion_sobre_mi)}}
                </textarea>
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
                        <option value="{{$tecnologia->nombre}}" 
                            @if(in_array($tecnologia->nombre, session('usuario')->perfilDesarrollador->tecnologiasConocidas->pluck('tecnologia.nombre')->toArray()))
                                selected
                            @endif>
                            {{$tecnologia->nombre}}
                        </option>
                    @endforEach
                </select>
                <small class="form-text text-muted">Selecciona varias opciones presionando Ctrl o Cmd.</small>
            </div>
    
            <!-- Niveles de conocimiento -->
            <div id="nivelesConocimiento" class="mb-3">
                <label class="form-label">Nivel de conocimiento por habilidad</label>

            </div>
            
    
            <!-- Botón de envío -->
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
    
    <script>
        const tecnologiasSelect = document.getElementById('tecnologias');
        const nivelesConocimientoDiv = document.getElementById('nivelesConocimiento');
    
        // Datos iniciales: tecnologías ya seleccionadas y sus niveles
        const tecnologiasGuardadas = @json(old('tecnologias', session('usuario')->perfilDesarrollador->tecnologiasConocidas->pluck('tecnologia.nombre')));
        const nivelesGuardados = @json(session('usuario')->perfilDesarrollador->tecnologiasConocidas->pluck('nivel_tecnologia', 'tecnologia.nombre'));
    
        // Preseleccionar tecnologías y generar niveles iniciales
        window.addEventListener('DOMContentLoaded', () => {
            Array.from(tecnologiasSelect.options).forEach(option => {
                if (tecnologiasGuardadas.includes(option.value)) {
                    option.selected = true;
                }
            });
    
            // Generar los niveles guardados
            tecnologiasGuardadas.forEach(tecnologia => {
                const nivel = nivelesGuardados[tecnologia] || ''; // Nivel guardado o vacío
                const fila = document.createElement('div');
                fila.className = 'row mb-2 align-items-center';
    
                fila.innerHTML = `
                    <div class="col-6">
                        <label class="form-label">${tecnologia}</label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" name="nivel[${tecnologia}]" value="${nivel}" placeholder="Nivel (1-10)" min="1" max="10" required>
                    </div>
                `;
    
                nivelesConocimientoDiv.appendChild(fila);
            });
        });
    
        // Detectar cambios en la selección de tecnologías
        tecnologiasSelect.addEventListener('change', () => {
            nivelesConocimientoDiv.innerHTML = '';
    
            Array.from(tecnologiasSelect.selectedOptions).forEach(option => {
                const tecnologia = option.value;
                const nivel = nivelesGuardados[tecnologia] || ''; // Mantén el nivel previo si existe
    
                const fila = document.createElement('div');
                fila.className = 'row mb-2 align-items-center';
    
                fila.innerHTML = `
                    <div class="col-6">
                        <label class="form-label">${tecnologia}</label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" name="nivel[${tecnologia}]" value="${nivel}" placeholder="Nivel (1-10)" min="1" max="10" required>
                    </div>
                `;
    
                nivelesConocimientoDiv.appendChild(fila);
            });
        });
    </script>
    

@include('layout.footer')
