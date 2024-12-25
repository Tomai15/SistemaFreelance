@include('layout.header')

<div class="proyectos container-fluid">

    <h2 class="mb-4 login">Proyectos Disponibles</h2>

    <!-- Filtrado y búsqueda -->
    <div class="filter-search-container">
        <button class="filter-button" id="filterModalToggle">Filtros</button>
        <input type="text" id="searchInput" placeholder="Buscar..." class="search-input">
        <button class="search-button" id="searchButton">Buscar</button>
        <a href="/proyectos/create" class="search-button proyectos-button">Crear Nuevo Proyecto</a>
    </div>
    
    <!-- Filter Modal -->
    <div class="modal" tabindex="-1" id="filterModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <nav class="nav nav-pills">
                        <a class="nav-link active" id="tabTecnologias" href="#tecnologias" data-bs-toggle="tab">Tecnologías</a>
                        <a class="nav-link" id="tabPrecio" href="#precio" data-bs-toggle="tab">Precio</a>
                        <a class="nav-link" id="tabHoras" href="#horas" data-bs-toggle="tab">Horas</a>
                        <a class="nav-link" id="tabUrgencia" href="#urgencia" data-bs-toggle="tab">Urgencia</a>
                        <a class="nav-link" id="tabConfidencialidad" href="#confidencialidad" data-bs-toggle="tab">Confidencialidad</a>
                    </nav>
                </div>
                <!-- Modal Body -->
                <div class="modal-body tab-content">
                    <!-- Tecnologías -->
                    <div class="tab-pane fade show active" id="tecnologias">
                        <ul id="tecnologiasList"></ul>
                    </div>
                    <!-- Precio -->
                    <div class="tab-pane fade" id="precio">
                        <div>
                            <label for="precioDesde">Desde:</label>
                            <input type="number" id="precioDesde" class="form-control">
                        </div>
                        <div>
                            <label for="precioHasta">Hasta:</label>
                            <input type="number" id="precioHasta" class="form-control">
                        </div>
                    </div>
                    <!-- Horas -->
                    <div class="tab-pane fade" id="horas">
                        <div>
                            <label for="horasDesde">Desde:</label>
                            <input type="number" id="horasDesde" class="form-control">
                        </div>
                        <div>
                            <label for="horasHasta">Hasta:</label>
                            <input type="number" id="horasHasta" class="form-control">
                        </div>
                    </div>
                    <!-- Urgencia -->
                    <div class="tab-pane fade" id="urgencia">
                        <ul>
                            <li><input type="radio" name="urgencia" value="Baja"> Baja</li>
                            <li><input type="radio" name="urgencia" value="Media"> Media</li>
                            <li><input type="radio" name="urgencia" value="Alta"> Alta</li>
                        </ul>
                    </div>
                    <!-- Confidencialidad -->
                    <div class="tab-pane fade" id="confidencialidad">
                        <ul>
                            <li><input type="radio" name="confidencialidad" value="Baja"> Baja</li>
                            <li><input type="radio" name="confidencialidad" value="Media"> Media</li>
                            <li><input type="radio" name="confidencialidad" value="Alta"> Alta</li>
                            <li><input type="radio" name="confidencialidad" value="Muy Alta"> Muy Alta</li>
                        </ul>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="resetButton">Resetear</button>
                    <button class="btn btn-primary" id="applyButton">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de la tabla -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>TÍTULO</th>
                    <th>TECNOLOGÍA</th>
                    <th>CANT HS EST.</th>
                    <th>URGENCIA</th>
                    <th>CONFIDENCIALIDAD</th>
                </tr>
            </thead>
            <tbody>
                @if($proyectos->count())
                    <!-- Filas repetidas para cada $proyecto -->
                    @foreach($proyectos as $proyecto)
                        <tr class="clickable-row" data-id="{{ $proyecto->id }}">
                            <td>{{ $proyecto->nombre_proyecto }}</td>
                            <td>{{ $proyecto->descripcion }}</td>
                            <td>{{ $proyecto->horas_estimadas }}</td>
                            <td>
                                @switch($proyecto->urgenciaEstablecida->nivel_urgencia)
                                    @case('Alta')
                                        <span class="status urgency-high">Alta</span>
                                        @break
                                    @case('Media')
                                        <span class="status urgency-medium">Media</span>
                                        @break
                                    @case('Baja')
                                        <span class="status urgency-low">Baja</span>
                                        @break
                                    @default
                                        <span class="status urgency-unknown">Desconocida</span>
                                @endswitch
                            </td>
                            <td>
                                @switch($proyecto->confidencialidadEstablecida->nivel_confidencialidad)
                                    @case('Muy Alta')
                                        <span class="status confidentiality-high">Muy Alta</span>
                                        @break
                                    @case('Alta')
                                        <span class="status confidentiality-high">Alta</span>
                                        @break
                                    @case('Media')
                                        <span class="status confidentiality-medium">Media</span>
                                        @break
                                    @case('Baja')
                                        <span class="status confidentiality-low">Baja</span>
                                        @break
                                    @default
                                        <span class="status urgency-unknown">Desconocida</span>
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No hay proyectos disponibles por el momento</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="pagination d-flex justify-content-between align-items-center">
            {{ $proyectos->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const tecnologias = ['HTML', 'CSS', 'JavaScript', 'React', 'Angular', 'Vue'];

    // Populate Tecnologías List
    const tecnologiasList = document.getElementById('tecnologiasList');
    tecnologias.forEach(tech => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<input type="checkbox" value="${tech}"> ${tech}`;
        tecnologiasList.appendChild(listItem);
    });

    // Modal Toggling
    const filterModal = new bootstrap.Modal(document.getElementById('filterModal'));
    const filterModalToggle = document.getElementById('filterModalToggle');
    filterModalToggle.addEventListener('click', () => {
        filterModal.show();
    });

    // Reset Filters
    const resetButton = document.getElementById('resetButton');
    resetButton.addEventListener('click', () => {
        document.querySelectorAll('#filterModal input').forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false;
            } else if (input.type === 'number') {
                input.value = '';
            }
        });
    });

    // Prefill Filters Based on Query Parameters
    const urlParams = new URLSearchParams(window.location.search);

    document.querySelectorAll('#tecnologiasList input').forEach(input => {
        input.checked = urlParams.getAll('tecnologias').includes(input.value);
    });

    ['precioDesde', 'precioHasta', 'horasDesde', 'horasHasta'].forEach(id => {
        const element = document.getElementById(id);
        if (urlParams.get(id)) element.value = urlParams.get(id);
    });

    document.querySelectorAll('input[name="urgencia"]').forEach(input => {
        input.checked = urlParams.get('urgencia') === input.value;
    });

    document.querySelectorAll('input[name="confidencialidad"]').forEach(input => {
        input.checked = urlParams.get('confidencialidad') === input.value;
    });

    // Apply Filters
    const applyButton = document.getElementById('applyButton');
    applyButton.addEventListener('click', () => {
        const selectedFilters = {
            tecnologias: Array.from(document.querySelectorAll('#tecnologiasList input:checked')).map(el => el.value),
            precioDesde: document.getElementById('precioDesde').value,
            precioHasta: document.getElementById('precioHasta').value,
            horasDesde: document.getElementById('horasDesde').value,
            horasHasta: document.getElementById('horasHasta').value,
            urgencia: document.querySelector('input[name="urgencia"]:checked')?.value || '',
            confidencialidad: document.querySelector('input[name="confidencialidad"]:checked')?.value || ''
        };

        // Build the query string
        const queryString = new URLSearchParams(selectedFilters).toString();

        // Redirect to the filtered URL
        window.location.href = `/proyectos?${queryString}`;
    });
});
</script>


@include('layout.footer')