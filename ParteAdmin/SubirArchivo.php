<?php
// Mostrar errores solo en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar configuración desde el archivo .env
$dotenv = parse_ini_file('.env');

//para contar las páginas de un PDF
require '../vendor/autoload.php'; //Cargar las dependencias de Composer
use setasign\Fpdi\Fpdi; //Uso de los namespaces


//Nueva conexión a la base de datos a través de PDO por razones de seguridad
try {
    $pdo = new PDO( 
        "mysql:host={$dotenv['DB_HOST']};dbname={$dotenv['DB_NAME']}",
        $dotenv['DB_USER'],
        $dotenv['DB_PASS'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

//función para contar páginas
function contarPaginasPDF($archivoPDF){
    $pdf = new Fpdi();
    $contarPags = $pdf->setSourceFile($archivoPDF); //contar las páginas
    return $contarPags; //devuelve numero de páginas
}

//Subir archivos PDF
//Se verifica que el servidor esté disponible y el archivo coincida con un archivo pdf
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) { 
    $target_dir = __DIR__ . "/Uploads/"; //En esta carpeta se van a subir los PDF (git ignorará los archivos nuevos)

    // Verificar que la carpeta exista o crearla
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); //Si no existe, la va a crear. 
    }

    $file_tmp = $_FILES["archivoPDF"]["tmp_name"]; //crea un nombretemporal en que se sube temporalmente en el servidor de PHP haciendo alusión a HTML = 'archivoPDF'
    $file_name = basename($_FILES["archivoPDF"]["name"]); //obtiene el nombre original con el que fue subido el archivo
    $file_type = mime_content_type($file_tmp); // Verificar el tipo MIME. Una capa extra de seguridad
    $max_size = 5 * 1024 * 1024; // 5 MB de tamaño máximo

    // Validaciones de seguridad
    if ($file_type !== "application/pdf") { //validación MIME
        die("Solo se permiten archivos PDF.");
    }

    if ($_FILES["archivoPDF"]["size"] > $max_size) {
        die("El archivo excede el tamaño máximo permitido (5 MB).");
    }

    //contar las páginas PDF
    $numeroPags = contarPaginasPDF($file_tmp);

    if ($numeroPags > 30){
        echo "El archivo contiene más de 30 páginas. ";
        exit;
    }

    // Renombrar el archivo para evitar sobrescritura
    $new_file_name = uniqid("doc_", true) . ".pdf";
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($file_tmp, $target_file)) {
        echo "El archivo se ha subido correctamente.<br>";
    
        try {
            // Insertar en la base de datos usando PDO
            $stmt = $pdo->prepare("
                INSERT INTO controlDocumentos 
                (NombreDocumento, FechaCreacion, UltimaModificacion, RutaArchivo, NumPags, Borrado) 
                VALUES (?, NOW(), NOW(), ?, ?, 0)
            ");
    
            // Ejecutar con los valores correctos
            $stmt->execute([$file_name, $target_file, $numeroPags]);
    
            // Obtener el último ID insertado
            $ultimo_id = $pdo->lastInsertId();
            echo "Subida exitosa a la base de datos. ID insertado: " . $ultimo_id;
        } catch (PDOException $e) {
            echo "Error al insertar en la base de datos: " . $e->getMessage();
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
    <link rel="preload" href="CSS/normalize.css" as="style">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link href="CSSAdm/CSSAdm.css" rel="stylesheet"> 
</head>
<body>
    <a href='../index.php' class="Pill--selected"> Regresar </a>
</body>
</html>
