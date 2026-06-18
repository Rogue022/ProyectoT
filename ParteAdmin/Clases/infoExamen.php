<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$llamadoDM = new DataManager;
$examen = $llamadoDM->_getExamen();
//$cuenta = count($examen);

if ($examen == FALSE) {
    echo "Examen Activo: Ninguno ";    
} else {
    echo "Examen activo: ". $examen['nomExamen']. "<br> ID: ". $examen['idExamen'];
}

?>