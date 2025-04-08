<?php
header('Content-Type: text/html; charset=UTF-8');

// Incluir autoload de Composer
require '../vendor/autoload.php'; // Cargar las dependencias de Composer
use setasign\Fpdi\Fpdi; // Uso de namespaces

// Verificar si el archivo se sube correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) {
    $target_dir = __DIR__ . "/Uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_tmp = $_FILES["archivoPDF"]["tmp_name"];
    $file_name = basename($_FILES["archivoPDF"]["name"]);
    $file_type = mime_content_type($file_tmp);
    $max_size = 5 * 1024 * 1024; // 5 MB

    if ($file_type !== "application/pdf") {
        die("Solo se permiten archivos PDF.");
    }

    if ($_FILES["archivoPDF"]["size"] > $max_size) {
        die("El archivo excede el tamaño máximo permitido (5 MB).");
    }

    $new_file_name = uniqid("doc_", true) . ".pdf";
    $target_file = $target_dir . $new_file_name;

    // Primero movemos el archivo
    if (move_uploaded_file($file_tmp, $target_file)) {
        
        // Ahora que está en su destino, usamos FPDI para contar páginas
        function contarPaginasPDF($archivoPDF)
        {
            $pdf = new Fpdi();
            return $pdf->setSourceFile($archivoPDF);
        }

        $numeroPags = contarPaginasPDF($target_file);

        if ($numeroPags > 30) {
            unlink($target_file); // Borra el archivo si no cumple la regla
            die("El archivo contiene más de 30 páginas.");
        }

        // Incluir clase y guardar en base de datos
        include 'Clases/class.DataManager.php';
        $ultimo_id = DataManager::insertDocument($file_name, $target_file, $numeroPags);

        if ($ultimo_id) {
            echo "Archivo subido y registrado exitosamente. ID: $ultimo_id";
        } else {
            echo "Archivo subido, pero no se pudo insertar en la base de datos.";
        }

    } else {
        echo "Error al mover el archivo.<br>";
        echo "Temp file: $file_tmp<br>";
        echo "Target file: $target_file<br>";
        echo "¿Existe el archivo temporal?: " . (file_exists($file_tmp) ? 'Sí' : 'No') . "<br>";
        echo "¿Existe el directorio destino?: " . (is_dir($target_dir) ? 'Sí' : 'No') . "<br>";
        echo "Permisos del destino: " . substr(sprintf('%o', fileperms($target_dir)), -4);
    }
}

