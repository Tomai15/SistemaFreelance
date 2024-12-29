@include('layout.header')

<div class="container-fluid">
    <h2 class="mb-4">Postulantes</h2>
    
    <!-- Tabla de postulantes -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Calificación Promedio</th>
                    <th>Tecnologías Conocidas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($postulantes && $postulantes->count())
                    @foreach($postulantes as $postulante)
                        <tr {{--onclick="window.location.href='/postulantes/{{ $postulante->id }}'"--}}>
                            <td>{{ $postulante->nombre }}</td>
                            <td>{{ $postulante->apellido }}</td>
                            <td>{{ $postulante->promedio_calificacion }}</td>
                            <td>
                                @foreach($postulante->tecnologiasConocidas as $tecnologiaConocida)
                                    <div>{{ $tecnologiaConocida->tecnologia->nombre }} ({{ $tecnologiaConocida->nivel_tecnologia }})</div>
                                @endforeach
                            </td>
                            <td>
                                <form action="/elegir-desarrollador/{{ $postulante->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Elegir Desarrollador</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">Nadie se ha postulado por el momento</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@include('layout.footer')
