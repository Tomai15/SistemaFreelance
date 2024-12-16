@include('layout.header')
<div class="proyectos container-fluid">

    <h2 class="mb-4 login">Proyectos Disponibles</h2>
    <!-- Filtrado y búsqueda -->

    <div class="filter-search-container">
        <li class="filter-dropdown">
            <button class="filter-button" data-bs-toggle="dropdown" role="button">▼</button>
            <ul class="dropdown-menu" id="sortDropdown">
                <!-- Dropdown items can be added here -->
                <li><a class="dropdown-item" href="#">Proyecto A - Z</a></li>
                <li><a class="dropdown-item" href="#">Proyecto Z - A</a></li>
            </ul>
        </li>
        <input type="text" id="searchInput" placeholder="Buscar..." class="search-input">
        <button class="search-button" id="searchButton">Buscar</button>
        <a href="#" class="search-button proyectos-button">Crear Nuevo Proyecto</a>
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
                <!-- Example rows -->
                <tr class="clickable-row" data-id="1">
                    <td>Proyecto Alpha</td>
                    <td>Java</td>
                    <td>120</td>
                    <td><span class="status urgency-high">Alta</span></td>
                    <td><span class="status confidentiality-very-high">Muy Alta</span></td>
                </tr>
                <tr class="clickable-row" data-id="2">
                    <td>Proyecto Beta</td>
                    <td>Python</td>
                    <td>80</td>
                    <td><span class="status urgency-medium">Media</span></td>
                    <td><span class="status confidentiality-medium">Media</span></td>
                </tr>
                <tr class="clickable-row" data-id="3">
                    <td>Proyecto Gamma</td>
                    <td>JavaScript</td>
                    <td>50</td>
                    <td><span class="status urgency-low">Baja</span></td>
                    <td><span class="status confidentiality-low">Baja</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Sección de paginación -->
    <div class="pagination">
        <span class="report-count">PROYECTOS DISPONIBLES: 3</span>
        <span class="page-info">1-3 de 3</span>
        <div class="pagination-controls">
            <a class="pagination-button" href="#" disabled>⬅</a>
            <span class="current-page">1/1</span>
            <a class="pagination-button" href="#" disabled>➡</a>
        </div>
    </div>

</div>
@include('layout.footer')