<?php
include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$numExamen = json_decode(file_get_contents('php://input'), true);
$llamadoDM = new DataManager;
$preguntas = $llamadoDM->_getPregunta();
count($preguntas);

$i = 0;

//Debido a que el idPregunta no es consistente y en un momento será recursivo conforme a un nuevo examen se genere, se hace la relación con NumPregunta

while ($i < count($preguntas)) {
    if ($preguntas[$i]['PreguntaExamen_idExamen'] == $numExamen) {
        echo "Examen id: ".$preguntas[$i]['PreguntaExamen_idExamen'];
        break;
    }
    $i++;
}