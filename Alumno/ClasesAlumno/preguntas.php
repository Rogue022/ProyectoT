<?php
include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$numPregunta = json_decode(file_get_contents('php://input'), true);
$llamadoDM = new DataManager;
$getNumExamen = $llamadoDM->_getExamen();
$numExamen=$getNumExamen['idExamen'];
$preguntas = $llamadoDM->_getPregunta($numExamen);
count($preguntas);

$i = 0;

//Debido a que el idPregunta no es consistente y en un momento será recursivo conforme a un nuevo examen se genere, se hace la relación con NumPregunta

while ($i < count($preguntas)) {
    if ($preguntas[$i]['NumPregunta'] == $numPregunta) {
        echo "Pregunta " . $preguntas[$i]['NumPregunta'] . " <br> " . $preguntas[$i]['NombrePregunta'] . "<br>";
    }
    $i++;
}