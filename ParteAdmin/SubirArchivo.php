<?php
// Mostrar errores solo en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar configuración desde el archivo .env
$dotenv = parse_ini_file('.env');

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) {
    $target_dir = __DIR__ . "/Uploads/";

    // Verificar que la carpeta exista o crearla
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_tmp = $_FILES["archivoPDF"]["tmp_name"];
    $file_name = basename($_FILES["archivoPDF"]["name"]);
    $file_type = mime_content_type($file_tmp); // Verificar el tipo MIME
    $max_size = 5 * 1024 * 1024; // 5 MB de tamaño máximo

    // Validaciones de seguridad
    if ($file_type !== "application/pdf") {
        die("Solo se permiten archivos PDF.");
    }

    if ($_FILES["archivoPDF"]["size"] > $max_size) {
        die("El archivo excede el tamaño máximo permitido (5 MB).");
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
                VALUES (?, NOW(), NOW(), ?, 1, 0)
            ");

            $stmt->execute([$file_name, $target_file]);

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