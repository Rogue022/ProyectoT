<?php
header('Content-Type: text/html; charset=UTF-8');
// Incluir autoload de Composer
require '../vendor/autoload.php'; // Cargar las dependencias de Composer para manejar el PDF
use setasign\Fpdi\Fpdi; // Uso de namespaces
// Subir archivos::
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) { //el formulario se envía con el método POST y se envía un archivo con nombre archivoPDF
    
    $directorioDestino = __DIR__ . "/Uploads/"; //carpeta de destino en donde se guardarán los archivos

    //conceder acceso al directorio "Uploads" donde se guardarán los documentos 
    if (!is_dir($directorioDestino)) { //si no se encuentra, lo crea
        mkdir($directorioDestino, 0755, true); //permiso para lectura y escritura
    }
    //copiar de manera temporal el archivo PDF
    $arch_tmp = $_FILES["archivoPDF"]["tmp_name"];  //RUTA temporal
    $nomArch = basename($_FILES["archivoPDF"]["name"]); //obtiene el mismo nombre del archivo fuente
    $tipoArch = mime_content_type($arch_tmp); //detecta el tipo MIME del archivo por su contenido para prevenir falsificaciones
    $max_size = 10 * 1024 * 1024; // tamaño máximo de los archivos

    //verificación que sea PDF
    if ($tipoArch !== "application/pdf") {
        die("Solo se permiten archivos PDF.");
    }
    //verificación del tamaño PDF
    if ($_FILES["archivoPDF"]["size"] > $max_size) {
        die("El archivo excede el tamaño máximo permitido (5 MB).");
    }

    //nuevo nombre de archivo para subirlo a la carpeta destino
    $nuevoNombre = uniqid("doc_", true) . ".pdf";
    $destArch = $directorioDestino . $nuevoNombre;



    // Primero movemos el archivo
    if (move_uploaded_file($arch_tmp, $destArch)) {
        
        // Ahora que está en su destino, usamos FPDI para contar páginas
        function contarPaginasPDF($archivoPDF)
        {
            $pdf = new Fpdi();
            return $pdf->setSourceFile($archivoPDF);
        }


        $numeroPags = contarPaginasPDF($destArch);
        
        if ($numeroPags > 30) {
            unlink($destArch); // Borra el archivo si no cumple la regla
            die("El archivo contiene más de 30 páginas.");
        }
        // Incluir clase y guardar en base de datos
        include 'Clases/class.DataManager.php';
        $ultimo_id = DataManager::insertarDocumento($nuevoNombre, $destArch, $numeroPags);
        if ($ultimo_id) {
            echo "Archivo subido y registrado exitosamente. ID: $ultimo_id";
        } else {
            echo "Archivo subido, pero no se pudo insertar en la base de datos.";
        }
    } else { //depurar algún error de subida de archivo
        echo "Error al mover el archivo.<br>";
        echo "Temp file: $arch_tmp<br>";
        echo "Target file: $destArch<br>";
        echo "¿Existe el archivo temporal?: " . (file_exists($arch_tmp) ? 'Sí' : 'No') . "<br>";
        echo "¿Existe el directorio destino?: " . (is_dir($directorioDestino) ? 'Sí' : 'No') . "<br>";
        echo "Permisos del destino: " . substr(sprintf('%o', fileperms($directorioDestino)), -4);
    }
}
