<?php
//establecer la fecha en la zona de cdmx
date_default_timezone_set('America/Mexico_City');

//establecer el idioma
setlocale(LC_TIME, 'es_MX.UTF-8');

/*Cabecera lateral */
include $_SERVER['DOCUMENT_ROOT'] . '/Templates/cabeceraLateral.php';
?>

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <h1> Captura de elementos mediante OCR </h1>
        </div>
        <div class="col">
            <!-- Formulario para subir PDF a la página -->
            <form class="ContenedorSubida" id='formulario_OCR_PDF' method="POST" enctype="multipart/form-data">
                <div class="container">

                    <label for="pdf_input">
                        <h6>Ingresa un PDF: </h6>
                    </label><br>
                    <input type="file" name="archivoPDF" id="pdf_input" accept="application/pdf" required />
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm">
                        Subir
                    </button>

                </div>
            </form>

        </div>
    </div>
    <!-- Muestra resultado de subida  -->
    <div id="mensajeResultado"></div>
    <!-- formulario de ingreso:  -->
    <?php include("../ParteAdmin/formularioIngreso.php"); ?>
    <!-- fin formulario de ingreso -->
</div>


<?php include("../Templates/piePagina.php"); ?>