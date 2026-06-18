<?php include("../Templates/cabeceraLateral.php"); ?>

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <h1> Examen activo </h1>
        <div class="col">
            <div class="row">
                <!-- Mostar el resultado de _getExamen de DataManager -->
                <h6 id="muestraActividad">Examen activo: Ninguno </h6>
            </div>
            <div class="row">
                <!-- Hacer un modify column  en data manager-->
                <ul class="list-unstyled">
                    <li>• Ingresa el id del examen que se activará y que podrán revisar Profesores y Alumnos.</li>
                    <li>• En caso de que otro examen esté activo, este pasará al estado "INACTIVO".</li>
                </ul>               
                    
                <form action="">
                    <input type="text">
                    <button class="btn btn-primary btn-sm" type="submit">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$examenActivo = document.getElementById('muestraActividad')

fetch('/ParteAdmin/Clases/infoExamen.php', {
        method: 'POST',
    })
        .then(respuesta => {
            return respuesta.text();
        })
        .then(contenido => {
            $examenActivo.innerHTML = contenido;
        })
        .catch(error => {
            console.error('Error al enviar los datos', error);
        })

</script>

<?php include("../Templates/piePagina.php"); ?>