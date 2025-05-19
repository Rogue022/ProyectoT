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
                                    value="inicio"
                                    id="tipo_examen" />
                                <label class="form-check-label" for="tipo_examen" required> Inicio </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    value="final"
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
                                    id="fecha_examen"
                                    value="<?php echo date('Y-m-d'); ?>" />
                            </div>

                            <!-- carreras -->
                            <p>Carrera:</p>
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
                                    style="text-transform:uppercase"
                                    id="escuela_procedencia" required />
                            </div>

                            <!-- reactivos -->
                            <p>Reactivos</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="pregunta_1" name="pregunta_1" />
                                <label class="form-check-label" for="reactivos"> Pregunta 1 </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="2"
                                    id="pregunta_2"
                                    name="pregunta_2" />
                                <label class="form-check-label" for="pregunta_2"> Pregunta 2 </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="2"
                                    id="pregunta_3"
                                    name="pregunta_3" />
                                <label class="form-check-label" for="pregunta_3"> Pregunta 3 </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="2"
                                    id="pregunta_4"
                                    name="pregunta_4" />
                                <label class="form-check-label" for="reactivos"> Pregunta 4 </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="2"
                                    id="pregunta_5"
                                    name="pregunta_5" />
                                <label class="form-check-label" for="pregunta_5"> Pregunta 5 </label>
                            </div>

                            <?php


                            ?>

                            <div class="mb-3">
                                <label for="calificacion" class="form-label">Calificación:</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="calificacion"
                                    id="calificacion"
                                    value="<?php echo $total; ?>" min="0" max="10" required />
                            </div>
                            <button
                                type="submit"
                                class="btn btn-danger">
                                Agregar
                            </button>

                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="col" id="columnaIzquierda">Aquí es PDF
    </div>
</div>


<script type="text/javascript">
    document.getElementById('formularioExamen').addEventListener("submit", function(event) {
        event.preventDefault();

        const datosForm = new FormData(this);

        fetch('recibeDatos.php', {
                method: 'POST',
                body: datosForm
            })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                document.getElementById("columnaIzquierda").innerHTML = contenido;
            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })

    });
</script>