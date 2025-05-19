<?php
require_once 'class.RegistroExamen.php';
require_once 'class.DataManager.php';  

$registro = new RegistroExamen([
    'tipoExamen' => $_POST['Examen'] ?? '',
    'fechaExamen' => $_POST['FechaExamen'] ?? ''
]);



if ($registro->validar()) {
    DataManager::guardaExamen($registro); 
    echo "Examen guardado correctamente";
} else {
    echo "Error al validar el formulario";
}
