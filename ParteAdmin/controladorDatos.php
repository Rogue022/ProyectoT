<?php

include 'Clases/class.ExamenValidador.php';
include 'Clases/class.Examen.php';
include 'Clases/class.DataManager.php';

//1. Primero, debe de armar el examen esta cosa pasando los datos
//del POST
$revisarExamen = new ValidadorExamen($_POST);

//primero set datos en validador
//2. Si se tienen los datos en el $_POST, se procede a revisarlos mediante (validar todo, si hay errores, devuelve false)
if ($revisarExamen->validarTodo($_POST)) {

    //una vez revisados, se recuperan y se almacenan en $datos para después armar el examen
    $datos = $revisarExamen->getDatos();

    //se arma el examen y se construye con los datos
    $examen = new Examen ($datos);

    //se evalúa el examen
    $examen->evaluar();

    //se muestran los resultados:
    print_r($examen->mostrarResultados());

    //se inserta el examen:
    DataManager::insertarExamen($examen->_getExamenFull());

    
} else {
    echo "Hay errores....";
}
