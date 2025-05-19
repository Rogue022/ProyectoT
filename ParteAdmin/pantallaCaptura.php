<!-- Index admin -->
<?php include("../Templates/cabeceraLateral.php");?>

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
                <button
                    type="submit"
                    class="btn btn-primary btn-sm">
                    Subir
                </button>
            </form>
        </div>
    </div>
    <!-- Muestra resultado de subida  -->
    <div id="mensajeResultado"></div>
    <!-- formulario de ingreso:  -->
    <?php include("../ParteAdmin/formularioIngreso.php"); ?>
    <!-- fin formulario de ingreso -->
</div>
<script>
    //script para subir el PDF, pero eso después. 
</script>

<?php include("../Templates/piePagina.php"); ?>