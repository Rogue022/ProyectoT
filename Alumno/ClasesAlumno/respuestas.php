<?php
include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$numPregunta = json_decode(file_get_contents('php://input'), true);
$llamadoDM = new DataManager;
$getNumExamen = $llamadoDM->_getExamen();
$numExamen=$getNumExamen['idExamen'];
$preguntas = $llamadoDM->_getPregunta($numExamen);
count($preguntas);

$i = 0;

while ($i < count($preguntas)) {
    if ($preguntas[$i]['NumPregunta'] == $numPregunta) {
        echo "Respuesta ". $preguntas[$i]['NumPregunta'] . " <br> " . $preguntas[$i]['Expresion'] . "<br>";
    }
    $i++;
}