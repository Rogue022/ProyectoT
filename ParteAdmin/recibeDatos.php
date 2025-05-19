<?php

include 'Clases/class.ExamenValidador.php';
include 'Clases/class.Examen.php';

$validador = new ValidarExamen();

if ($validador->validarTodo($_POST)) {
    $validador->normalizar($_POST);

    $datos = array_merge(
        $validador->getDatosNormalizados(),
        $_POST // incluye preguntas
    );

    $examen = new Examen($datos);
    $examen->evaluar();
    $examen->mostrarResultados();
} else {
    $errores = $validador->obtenerErrores();
    foreach ($errores as $campo => $mensaje) {
        echo "<p>Error en <strong>$campo</strong>: $mensaje</p>";
    }
}
