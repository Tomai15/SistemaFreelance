@include('layout.header')

<main class="">
    <div class="d-flex align-items-center text-gray">
        <div class="container m-5">
            <form>
                <div class="mb-3 mx-5">
                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                    <input type="text" class="form-control" id="nombreProyecto" aria-describedby="projectHelp">
                    <div id="projectHelp" class="form-text">Cuéntanos que necesitas hecho.</div>
                </div>
                <div class="mb-3 mx-5">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                        aria-describedby="descripcionHelp"></textarea>
                    <div id="projectHelp" class="form-text">Ingrese algunas viñetas o descripción completa. Cuanto
                        más detallado, mejor.</div>
                </div>
                <div class="mb-3 mx-5">
                    <label for="formFile" class="form-label">Documento de Requerimientos</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="row g-1 mx-5 mb-3">
                    <div class="col-md-6">
                        <label for="horas_estimadas" class="form-label">Horas Estimadas</label>
                        <input type="number" class="form-control" id="horasEstimadas" placeholder="hs">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Nivel de Urgencia</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>Alto</option>
                            <option>Medio</option>
                            <option>Bajo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" placeholder="$">
                    </div>
                </div>

                <div class="row g-1 mx-5 mb-3">
                    <div class="col-md-12">
                        <label for="horas_estimadas" class="form-label">Tecnologías de Preferencia</label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">PHP</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Java</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Javascript</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Kotlin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Laravel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">React</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Angular</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Blade</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Bootstrap</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">VUE</label>
                        </div>

                    </div>
                </div>



                <button type="submit" class="btn btn-primary text-center">Crear</button>
            </form>
        </div>

</main>


@include('layout.footer')