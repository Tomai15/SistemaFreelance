@include('layout.header')

<main class="">

    <div class="d-flex align-items-center background text-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bolder">Freelance por plata</h1>
                    <p class="lead fs-2 my-3">Es un servicio de freenlance que conecta a personas con
                        nececidad de algun desarrollo de software y personas con la habilidad para desarrollarlo.</p>
                    <a href="#footer" class=" my-2 btn btn-info btn-lg">Saber más</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center image">
        <div class="container">
            <div class="row  my-5">
                <div class="col-md-6 my-2">
                    
                    <a href="/proyectos" class="btn btn-light border btn-lg fs-4 display-6 p-3 ms-5">Accerder a proyectos disponiles</a>
                </div>
                <div class="col-md-6 my-2">
                    <a href="/proyectos/create" class="btn btn-light border fs-4 btn-lg p-3 ms-5">Publica tu proyecto a concretar</a>
                   {{--  <h3>Texto explicativo de la funcion</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel velit neque. Fusce id lectus
                        id neque vehicula luctus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor justo vitae justo
                        ultricies, ac luctus metus ultricies.</p> --}}
                </div>
            </div>
        </div>
    </div>

</main>


@include('layout.footer')
