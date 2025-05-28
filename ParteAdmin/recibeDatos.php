<?php

include 'Clases/class.ExamenValidador.php';
include 'Clases/class.Examen.php';
include 'Clases/class.DataManager.php';

//1. Primero, debe de armar el examen esta cosa pasando los datos
//del POST
$examen = new ValidadorExamen($_POST);

//primero set datos en validador

$examen->validarTodo($_POST);

print_r($examen->getDatos());