<?php 

//print_r($_POST); 


$pregunta1 = (isset($_POST['pregunta_1'])) ? $_POST['pregunta_1'] : 0;
$pregunta2 = (isset($_POST['pregunta_2'])) ? $_POST['pregunta_2'] : 0;
$pregunta3 = (isset($_POST['pregunta_3'])) ? $_POST['pregunta_3'] : 0;
$pregunta4 = (isset($_POST['pregunta_4'])) ? $_POST['pregunta_4'] : 0;
$pregunta5 = (isset($_POST['pregunta_5'])) ? $_POST['pregunta_5'] : 0;

$preguntas = [$pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5];

$total = 0;

//print_r($preguntas);

foreach ($preguntas as $key => $pregunta) {
    if ($pregunta === 0) {
        continue;
    } else {
        $total = $total+$pregunta;
    }
    
}

echo "Calificación: ".$total;
?>