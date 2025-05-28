<?php

include 'Clases/class.ExamenValidador.php';
include 'Clases/class.Examen.php';
include 'Clases/class.DataManager.php';

//1. Primero, debe de armar el examen esta cosa pasando los datos
//del POST
$revisarExamen = new ValidadorExamen($_POST);

//primero set datos en validador

if ($revisarExamen->validarTodo($_POST)) {

    $datos = $revisarExamen->getDatos();

    $examen = new Examen ($datos);

    echo "Hola";

    $examen->evaluar();

    print_r($examen->mostrarResultados());

    DataManager::insertarExamen($examen->_getExamenFull());
    
} else {
    echo "Hay errores....";
}
