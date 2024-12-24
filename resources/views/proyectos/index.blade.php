@include('layout.header')

<div class="proyectos container-fluid">

    <h2 class="mb-4 login">Proyectos Disponibles</h2>
    <!-- Filtrado y búsqueda -->

    <div class="filter-search-container">
        <li class="filter-dropdown">
            <button class="filter-button" data-bs-toggle="dropdown" role="button">▼</button>
            <ul class="dropdown-menu" id="sortDropdown">
                <!--
                <li><a class="dropdown-item" data-sort="nombreProyecto" data-order="asc">Proyecto A - Z</a></li>
                <li><a class="dropdown-item" data-sort="nombreProyecto" data-order="desc">Proyecto Z - A</a></li>
                -->
            </ul>
        </li>
        <input type="text" id="searchInput" placeholder="Buscar..." class="search-input">
        <button class="search-button" id="searchButton">Buscar</button>
        <a href="/proyectos/create" class="search-button proyectos-button">Crear Nuevo Proyecto</a>
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
                                    @case('Alto')
                                        <span class="status urgency-high">Alto</span>
                                        @break
                                    @case('Medio')
                                        <span class="status urgency-medium">Medio</span>
                                        @break
                                    @case('Bajo')
                                        <span class="status urgency-low">Bajo</span>
                                        @break
                                    @default
                                        <span class="status urgency-unknown">Desconocido</span>
                                @endswitch
                            </td>
                            <td>
                                @switch($proyecto->confidencialidadEstablecida->nivel_confidencialidad)
                                    @case('Muy Alto')
                                        <span class="status confidentiality-high">Muy Alto</span>
                                        @break
                                    @case('Alto')
                                        <span class="status confidentiality-high">Alto</span>
                                        @break
                                    @case('Medio')
                                        <span class="status confidentiality-medium">Medio</span>
                                        @break
                                    @case('Bajo')
                                        <span class="status confidentiality-low">Bajo</span>
                                        @break
                                    @default
                                        <span class="status urgency-unknown">Desconocido</span>
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

@include('layout.footer')