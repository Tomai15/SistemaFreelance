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
        <a href="{{ route('proyectos.create') }}" class="search-button proyectos-button">Crear Nuevo Proyecto</a>
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
                    <!-- Repeatable row structure for each$proyecto -->
                    @foreach($proyectos as $proyecto)
                        <tr class="clickable-row" data-id="{{ $proyecto->id }}">
                            <td>{{ $proyecto->titulo }}</td>
                            <td>{{ $proyecto->tecnologia }}</td>
                            <td>{{ $proyecto->horas }}</td>
                            <td>
                                @switch($proyecto->urgencia)
                                    @case('alta')
                                        <span class="status urgency-high">Alta</span>
                                        @break
                                    @case('media')
                                        <span class="status urgency-medium">Media</span>
                                        @break
                                    @case('baja')
                                        <span class="status urgency-low">Baja</span>
                                        @break
                                    @default
                                        <span class="status urgency-unknown">Desconocida</span>
                                @endswitch
                            </td>
                            <td>
                                @switch($proyecto->confidencialidad)
                                    @case('muyAlta')
                                        <span class="status confidentiality-high">Muy Alta</span>
                                        @break
                                    @case('alta')
                                        <span class="status confidentiality-high">Alta</span>
                                        @break
                                    @case('media')
                                        <span class="status confidentiality-medium">Media</span>
                                        @break
                                    @case('baja')
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

    <!-- Sección de paginación -->
    <div class="pagination">
        <span class="report-count">PROYECTOS DISPONIBLES: {{ $totalProyectos }}</span>
        <span class="page-info">{{ $paginationStart }}-{{ $paginationEnd }} de {{ $totalProyectos }}</span>
        <div class="pagination-controls">
            <a class="pagination-button" href="{{ $previousPageUrl }}" @if($isFirstPage) disabled @endif>⬅</a>
            <span class="current-page">{{ $currentPage }}/{{ $totalPages }}</span>
            <a class="pagination-button" href="{{ $nextPageUrl }}" @if($isLastPage) disabled @endif>➡</a>
        </div>
    </div>

</div>

@include('layout.footer')