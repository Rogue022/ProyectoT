<?php

include_once(__DIR__ . '/../../ParteAdmin/Clases/class.DataManager.php');
$numPregunta = json_decode(file_get_contents('php://input'), true);
$llamadoDM = new DataManager;

echo "Número de pregunta: " . $numPregunta . "<br>";

$preguntas = $llamadoDM->_getPregunta();
count($preguntas);

$i = 0;

while ($i < count($preguntas)) {
    if ($preguntas[$i]['idPregunta'] == $numPregunta) {
        echo "Pregunta " . $preguntas[$i]['NombrePregunta'] . "<br>";
        echo "Respuesta " . $preguntas[$i]['idPregunta'] . " " . $preguntas[$i]['Expresion'] . "<br>";
    }
    $i++;
}
