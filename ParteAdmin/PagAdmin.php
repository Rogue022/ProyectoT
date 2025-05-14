<?php include("../Templates/cabeceraLateral.php"); ?>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <h1> Captura de elementos </h1>
        </div>
        <div class="col">
            <!-- Formulario para subir PDF a la BD -->
            <form class="ContenedorSubida" id='formularioSubida' method="POST" enctype="multipart/form-data">
                <label for="PDF">PDF:</label>
                <input type="file" name="archivoPDF" id="PDF" accept="application/pdf" required />
                <button type="submit">Subir</button>
            </form>
        </div>
    </div>
    <!-- Muestra resultado de subida  -->
    <div id="mensajeResultado"></div>

    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <!--Captura de datos manuales -->
            <section>
                <br>
                <div class="card">
                    <div class="card-body">
                        <form id='formularioExamen' method="POST">
                            <div class="mb-3">
                                <!-- Tipo examen (inicio o final) -->
                                <p>Examen: </p>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="tipo_examen"
                                        value="1"
                                        id="tipo_examen" />
                                    <label class="form-check-label" for="tipo_examen" required> Inicio </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="2"
                                        name="tipo_examen"
                                        id="tipo_examen" />
                                    <label class="form-check-label" for="tipo_examen"> Final </label>
                                </div>
                                <!-- Fecha del examen -->
                                <div class="mb-3">
                                    <label for="" class="form-label" required>Fecha examen</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="fecha_examen"
                                        id="fecha_examen" />
                                </div>

                                <!-- carreras -->
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="nombre_carrera"
                                        id="IC"
                                        value="IC" />
                                    <label class="form-check-label" for="IC"> Ingeniería en Computación </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="nombre_carrera"
                                        id="ISISA"
                                        value="ISISA" />
                                    <label class="form-check-label" for="ISISA">
                                        Ingeniería en Sistemas Automotrices
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="nombre_carrera"
                                        id="IM"
                                        value="IM" />
                                    <label class="form-check-label" for="IM">
                                        Ingeniería Mecánica
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="nombre_carrera"
                                        id="ICE"
                                        value="ICE" />
                                    <label class="form-check-label" for="ICE">
                                        Ingeniería en Comunicaciones y Electrónica
                                    </label>
                                </div>

                                <!-- Escuela de procedencia -->
                                <div class="mb-3">
                                    <label for="escuela_procedencia" class="form-label">Escuela:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="escuela_procedencia"
                                        id="escuela_procedencia" />
                                </div>

                                

                        </form>
                    </div>
                </div>


                <form id='formularioExamen' method="POST">
                    <label for="Examen" class="Pill">Examen: </label>
                    <br><input type="radio" name="Examen" id="Examen" value="1" required /> Inicio
                    <br><input type="radio" name="Examen" id="Examen" value="2" required /> Final
                    <br>
                    <label for="FechaExamen">Fecha del Examen:</label>
                    <input type="date" name="FechaExamen" required>
                    <br>
                    <label for="Carrera">Carrera: </label>
                    <br><input type="radio" name="Carrera" id="Carrera" value="1" required /> I.C.
                    <br><input type="radio" name="Carrera" id="Carrera" value="2" required /> I.C.E.
                    <br><input type="radio" name="Carrera" id="Carrera" value="3" required /> I.M.
                    <br><input type="radio" name="Carrera" id="Carrera" value="4" required /> I.S.I.S.A.
                    <br>
                    <br>
                    <label>Escuela de procedencia: </label>
                    <input type="Text" name="Escuela" required>
                    <br>
                    <br>
                    <p>Reactivos correctos: </p>
                    <label for="P1">Pregunta 1 </label>
                    <input type="checkbox" name="Reactivos[]" id="P1">
                    <br><label for="P2">Pregunta 2 </label>
                    <input type="checkbox" name="Reactivos[]" id="P2">
                    <br><label for="P3">Pregunta 3 </label>
                    <input type="checkbox" name="Reactivos[]" id="P3">
                    <br><label for="P4">Pregunta 4 </label>
                    <input type="checkbox" name="Reactivos[]" id="P4">
                    <br>
                    <br>
                    <label for="calificacion">Calificación </label>
                    <br><input type="number" name="Calificacion" id="calificacion" value="0" min="0" max="10" required>
                    <br><br>
                    <input type="submit" value="Registrar Examen">
                </form>
            </section>
        </div>

        <div class="col">Aquí es PDF
        </div>
    </div>
</div>


<script>
    document.getElementById('formularioSubida').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch('SubirArchivo.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('mensajeResultado').innerHTML = data;
                form.reset(); // Limpia el formulario si quieres
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('mensajeResultado').innerHTML = 'Hubo un error al subir el archivo.';
            });
    });

    document.getElementById('formularioExamen').addEventListener('submit', function(e) {
        e.preventDefault(); //previene la carga de la página

        const form = e.target;
        const formData = new FormData(form);

        fetch('Clases/class.ProcesaFormulario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('mensajeResultado').innerHTML = data;
                form.reset(); // Limpia el formulario si quieres
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('mensajeResultado').innerHTML = 'Error al guardar la información';
            });
    });
</script>
<br>

<?php include("../Templates/piePagina.php"); ?>