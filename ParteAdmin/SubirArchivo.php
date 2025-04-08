<?php
header('Content-Type: text/html; charset=UTF-8');

// Incluir autoload de Composer
require '../vendor/autoload.php'; // Cargar las dependencias de Composer
use setasign\Fpdi\Fpdi; // Uso de namespaces

// Verificar si el archivo se sube correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) {
    $target_dir = __DIR__ . "/Uploads/";

    // Verificar que la carpeta exista o crearla
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_tmp = $_FILES["archivoPDF"]["tmp_name"];
    $file_name = basename($_FILES["archivoPDF"]["name"]);
    $file_type = mime_content_type($file_tmp);
    $max_size = 5 * 1024 * 1024; // 5 MB

    // Validaciones de seguridad
    if ($file_type !== "application/pdf") {
        die("Solo se permiten archivos PDF.");
    }

    if ($_FILES["archivoPDF"]["size"] > $max_size) {
        die("El archivo excede el tamaño máximo permitido (5 MB).");
    }

    // Función para contar las páginas de un PDF
    function contarPaginasPDF($archivoPDF)
    {
        $pdf = new Fpdi();
        return $pdf->setSourceFile($archivoPDF); // Retorna el número de páginas
    }

    // Contar las páginas del archivo PDF
    $numeroPags = contarPaginasPDF($file_tmp);

    if ($numeroPags > 30) {
        echo "El archivo contiene más de 30 páginas. ";
        exit;
    }

    // Renombrar el archivo para evitar sobrescritura
    $new_file_name = uniqid("doc_", true) . ".pdf";
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($file_tmp, $target_file)) {
        echo "El archivo se ha subido correctamente.<br>";

        // Incluir la clase DataManager para insertar en la base de datos
        include 'Clases/class.DataManager.php';

        // Llamar al método de la clase DataManager para insertar el registro
        $ultimo_id = DataManager::insertDocument($file_name, $target_file, $numeroPags);

        if ($ultimo_id) {
            echo "Subida exitosa a la base de datos. ID insertado: " . $ultimo_id;
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de archivo</title>
    <link rel="stylesheet" href="CSS/normalize.css">
    <link href="CSSAdm/CSSAdm.css" rel="stylesheet">
</head>

<body>
    <a href='PagAdmin.php' class="Pill--selected"> Regresar </a>
</body>

</html>