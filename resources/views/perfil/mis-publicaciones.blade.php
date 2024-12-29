@include('layout.header')

<div class="proyectos container-fluid">
    <h2 class="mb-4 login">Mis proyectos publicados</h2>

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
    <div class="table-container" id="tabla-proyectos">
        <table>
            <thead>
                <tr>
                    <th>TÍTULO</th>
                    <th>TECNOLOGÍAS</th>
                    <th>PRECIO (USD)</th>
                    <th>CANT HS EST.</th>
                    <th>URGENCIA</th>
                    <th>CONFIDENCIALIDAD</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @if($proyectos->count())
                    @foreach($proyectos as $proyecto)
                    <tr class="clickable-row" onclick="window.location.href='/proyectos/{{ $proyecto->id }}'">
                            <td>{{ \Illuminate\Support\Str::limit($proyecto->nombre_proyecto, 40, '...') }}</td>
                            <td>
                                @php
                                    $tecnologias = $proyecto->tecnologias->pluck('nombre');
                                    $visibleTecnologias = $tecnologias->take(3);
                                    $remainingCount = $tecnologias->count() - $visibleTecnologias->count();
                                @endphp
                            	
                                {{ $visibleTecnologias->join(', ') }}
                                @if ($remainingCount > 0)
                                    y {{ $remainingCount }} más
                                @endif
                            </td>
                            <td>{{ $proyecto->precio }}</td>
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
                            <td>
                                @switch($proyecto->estado)
                                    @case('esperando')
                                        <span class="status waiting">Esperando elección de postulante</span>
                                        @break
                                    @case('postulante_elegido')
                                        <span class="status chosen">Postulante elegido</span>
                                        @break
                                    @case('finalizado')
                                        <span class="status finished">Finalizado</span>
                                        @break
                                    @default
                                        <span class="status unknown">Desconocido</span>
                                @endswitch
                            </td>
                            <td>
                                <a href="/proyectos/{{ $proyecto->id }}/edit" class="btn btn-warning">Editar</a>
                                <form action="/proyectos/{{ $proyecto->id }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <a href="/misPublicaciones/{{ $proyecto->id }}/postulantes" class="btn btn-info">Ver Postulantes</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">No tiene publicaciones</td>
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
        filterModal.toggle();
    });
});
</script>

@include('layout.footer')
