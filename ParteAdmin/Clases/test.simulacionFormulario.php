<?php
require_once 'class.RegistroExamen.php';



echo "Simulación de formulario";

$datos = [
    'tipo_examen' => '1',
    'fecha_examen' => '2025-06-10'
];

//$registro = new RegistroExamen();
$registro = new RegistroExamen($_POST);

print_r($_POST); // << Te muestra qué datos llegaron
print_r($registro); // << Para ver qué se asignó

//var_dump($registro);

if ($registro->validar()) {
    echo "✅ El formulario es válido.\n";
    echo "Tipo de examen: " . $registro->tipoExamen . "\n";
    echo "Fecha de examen: " . $registro->fechaExamen . "\n";
} else {
    echo "❌ El formulario tiene errores.\n";
    // Si agregamos manejo de errores después, aquí los podríamos imprimir
}
