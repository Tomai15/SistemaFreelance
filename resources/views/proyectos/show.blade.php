@include('layout.header')


<main class="">
    <div class="container py-4">
      <div class="row g-3">
        <!-- Content Project Card -->
        <div class="col-md-8">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Titulo del Proyecto</h5>
              <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti at debitis cum alias incidunt obcaecati numquam, doloremque amet nihil officiis, quasi voluptatem aliquid accusamus. Ab, numquam. Voluptates explicabo rerum veniam! With supporting text below as a natural lead-in to additional content.</p>
              <div class="py-2">
                <h6>Tecnologías requeridas:</h6>
                  <div class="tags">
                    <span class="badge bg-warning text-dark">HTML</span>
                    <span class="badge bg-info text-dark">CSS</span>
                    <span class="badge bg-info text-dark">JavaScript</span>
                    <span class="badge bg-info text-dark">Bootstrap 5</span>
                    <span class="badge bg-info text-dark">Python</span>
                  </div>
              </div>     
                  <hr>
                  <h6>Documento Disponible:</h6>
                  <div class="my-3">
                    <a href="#" class="text-decoration-none text-primary">Requerimientos Funcionales (PDF)</a>
                  </div>
                  <div class="py-3 text-center" >
                    <a href="#" class="btn btn-success  fw-bold ">Postulate</a>
                  </div>   
            </div>
          </div>
        </div>
      <!-- Content-side Card -->
      <div class="col-md-4">
        <div class="card h-100 bg-light">
          <div class="card-body ">
            <h5 class="card-title">Acerca del cliente</h5>
            <div class="card-text">
              <ul>
                <li>(flag)Bs As, Argentina</li>
                <li>Miembro desde (fecha) </li>
                <li>Ha concretado 18 proyectos</li>
                <li>(iconVisto)Payment method verified</li>
              </ul>
              Este espacio es ideal para contenido adicional como enlaces, listas o información secundaria.
            </div>
            <a href="#" class="btn btn-secondary">More Info</a>
          </div>
        </div>
      </div>
    </div>
    
    <div class=" mt-5 py-3">
      <p class="mb-4 fw-bold">3 freelancers estan postulados en este trabajo</p>
      <div class="row g-3">
        <!-- Card del Postulante -->
        <div class="col-8">
          <div class="card p-3">
            <div class="d-flex align-items-center">
              <!-- Foto del Postulante -->
              <img src="https://via.placeholder.com/100" class="rounded-circle me-3" alt="Foto del Postulante" width="100" height="100">
              <!-- Información del Postulante -->
              <div>
                <h5 class="card-title mb-1">@tomai15</h5>
                <p class="card-text mb-1">Desarrollador web con experiencia en tecnologías como HTML, CSS, y JavaScript. Apasionado por el diseño de interfaces intuitivas.</p>
                <div class="text-muted">Puntuación: <strong>4.8/5</strong></div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-8">
          <div class="card p-3">
            <div class="d-flex align-items-center">
              <img src="https://via.placeholder.com/100" class="rounded-circle me-3" alt="Foto del Postulante" width="100" height="100">
              <div>
                <h5 class="card-title mb-1">@carish</h5>
                <p class="card-text mb-1">Ingeniera de software especializada en backend con Python y Django. Experta en desarrollo de APIs robustas.</p>
                <div class="text-muted">Puntuación: <strong>4.7/5</strong></div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-8">
          <div class="card p-3">
            <div class="d-flex align-items-center">
              <img src="https://via.placeholder.com/100" class="rounded-circle me-3" alt="Foto del Postulante" width="100" height="100">
              <div>
                <h5 class="card-title mb-1">@matt</h5>
                <p class="card-text mb-1">Diseñador gráfico con experiencia en branding y diseño digital. Entusiasta del diseño UX/UI.</p>
                <div class="text-muted">Puntuación: <strong>4.9/5</strong></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
      
  </main>

@include('layout.footer')