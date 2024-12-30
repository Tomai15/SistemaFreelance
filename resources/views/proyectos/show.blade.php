@include('layout.header')

@if (session('error'))
    <div class="alert alert-danger mt-3 text-center">
        {{ session('error') }}
    </div>
@endif
              
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif 


<main class="">
  <div class="container py-4">
    <a href="/proyectos" class="btn btn-secondary mb-3">← Volver</a>
      <div class="row g-3">
          <!-- Content Project Card -->
          <div class="col-md-8">
              <div class="card h-100">
                  <div class="card-body">
                      <h5 class="card-title">{{ $proyecto->nombre_proyecto }}</h5>
                      <p class="card-text">{{ $proyecto->descripcion }}</p>
                      <div class="py-2">
                        <p><strong>Precio:</strong> US${{ number_format($proyecto->precio, 2) }}</p>
                        <p><strong>Horas Estimadas de Desarrollo:</strong> {{ $proyecto->horas_estimadas }} horas</p>
                          <h6>Tecnologías requeridas:</h6>
                          <div class="tags">
                              @foreach ($proyecto->tecnologias as $tecnologia)
                                  <span class="badge bg-warning text-dark">{{ $tecnologia->nombre }}</span>
                              @endforeach
                          </div>
                      </div>     
                      <hr>
                      @if ($proyecto->url_documento_requerimientos)
                      <h6>Documento Disponible:</h6>
                      <div class="my-3">
                          <a href="{{ route('proyecto.descargar', $proyecto->id) }}" target="_blank" class="btn btn-primary btn-sm">
                              <i class="bi bi-download"></i> Descargar Requerimientos
                          </a>
                      </div>
                      @endif
                      <div class="py-3 text-center">
                          @if (!session()->has('usuario'))
                              <!-- Redirect to Login if Not Logged In -->
                              <a href="/login" class="btn btn-success fw-bold">Postulate</a>
                          @else
                              <form method="POST" action="{{ route('proyectos.postular', $proyecto->id) }}">
                                  @csrf
                                  @if (session('usuario')->perfilDesarrollador)
                                      <!-- Allow Posting if User Has Perfil -->
                                      <button type="submit" class="btn btn-success fw-bold">Postulate</button>
                                  @else
                                      <!-- Trigger Modal if User Doesn't Have Perfil -->
                                      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#noPerfilModal">
                                          Postulate
                                      </button>
                                  @endif
                              </form>
                          @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 bg-light">
              <div class="card-body ">
                <h5 class="card-title">Cantidad postulados</h5>
                <div class="card-text">
                  <ul>
                    @if($proyecto->postulaciones->count())
                      <li>
                        <i class="bi bi-person-check-fill"></i> 
                        Ha recibido postulaciones de 
                        <strong>{{ $proyecto->postulaciones->count() }}</strong> 
                        freelancers
                      </li>
                    @else
                      <li>
                        Nadie se ha postulado a este proyecto  
                        <strong>¡Se el primero!</strong> 
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
      </div>
      
      <!-- Modal for No PerfilDesarrollador -->
      <div class="modal fade" id="noPerfilModal" tabindex="-1" aria-labelledby="noPerfilModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="noPerfilModalLabel">Perfil Requerido</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      No tienes un Perfil Desarrollador creado. ¿Deseas crear uno ahora?
                  </div>
                  <div class="modal-footer">
                      <a href="/crearPerfil" class="btn btn-primary">Sí, crear perfil</a>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Más tarde</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
</main>

@include('layout.footer')