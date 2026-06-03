<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//agregar accionEnvio.php

?>


<!DOCTYPE html>
<!-- en caso de:  <html lang="en" data-bs-theme="dark">  -->
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar guías de estudio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="/Alumno/CSSAlumno/estiloA.css">

</head>



<body>
    <div class="container">
        <div class="main-container">
            <div class="main-title">
                <h4>Enviar guías de estudio</h4>
            </div>
            <div class="row">
                <h6>1. Elije los temas de estudio que quieres recibir a un correo electrónico
                </h6>
            </div>
            <div class="row">
                <h6>2. Ingresa un correo electrónico para enviar esta información.</h6>
            </div>
            <form id="enviarInformacion" method="POST">
                <div class="row needs-validation">
                    <div class="col-sm">
                        <div class="main-cards">
                            <div class="card">
                                <div class="form-check">

                                    <label for="checkbox1" class="form-check-label">Aritmética</label>
                                    <input type="checkbox" class="form-check-input" value="" id="checkbox1" checked>

                                    <label for="checkbox2" class="form-check-label">Álgebra</label>
                                    <input type="checkbox" class="form-check-input" value="" id="checkbox2">

                                    <label for="checkbox3" class="form-check-label">Geometría</label>
                                    <input type="checkbox" class="form-check-input" value="" id="checkbox3">

                                    <label for="checkbox4" class="form-check-label">Cálculo</label>
                                    <input type="checkbox" class="form-check-input" value="" id="checkbox4">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="correo-e">Ingresa tu correo electrónico:</label>
                        <br>
                        <input type="email" id="correo-e" value="john@ejemplo.com" name="correo-e" required>
                        <br>
                        <div class="invalid-feedback">
                            Ingresa un correo válido
                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-secondary" onclick="history.back()">
                                    Regresar
                                </button>

                                <!-- ========== Start Modal ========== -->
                                <dialog id="modal" class="dialog">
                                    <h5>Confirmación</h5>
                                    <p>¿Enviar correo?</p>
                                    <button type="button" class="btn btn-info" id="closeDialog">Regresar</button>
                                    <button type="button" class="btn btn-warning" id="endDialog">Finalizar</button>
                                </dialog>

                                <!-- ========== End Modal ========== -->

                                <button type="submit" value="submit" class="btn btn-success" id="enviarInfo">
                                    Enviar correo
                                </button>



                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        const dialog = document.getElementById('modal');
        const btnEnv = document.getElementById('enviarInfo');

        //Para mostrar el modal:
        /*
                btnEnv.addEventListener('click', e => {
                        dialog.showModal();
                    });
        */
        document.getElementById('enviarInformacion').addEventListener("submit", function(event) {
        event.preventDefault();

        const datosForm = new FormData(this);

        fetch('/Alumno/ClasesAlumno/accionEnvio.php', {
                method: 'POST',
                body: datosForm
            })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                alert("Elemento enviado");
            
            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })

    });
    </script>


</body>

</html>