<?php
include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$numExamen = json_decode(file_get_contents('php://input'), true);
$llamadoDM = new DataManager;
$examen = $llamadoDM->_getExamen();
//$cuenta = count($examen);

if ($examen['nomExamen'] != NULL ) {
    echo "Examen: ".$examen['nomExamen'];
} else {
    echo "No hay examen activo. Contacte al administrador.";
}



