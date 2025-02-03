<!-- Formulario para subir la información a la BD -->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) {
        $target_dir = __DIR__ . "/Uploads/";
        $file_name = basename($_FILES["archivoPDF"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if ($file_type != "pdf") {
            echo "Solo se permiten archivos PDF.";
            exit;
        }
    
        if (move_uploaded_file($_FILES["archivoPDF"]["tmp_name"], $target_file)) {
            echo "El archivo se ha subido correctamente.<br>";
    
            // Conexión a la base de datos
            $conn = new mysqli('localhost', 'AdmnP', 'Revenant2159!', 'SistemaExamenes');
    
            // Verificar conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
    
            // Insertar en la base de datos
            $stmt = $conn->prepare("INSERT INTO controlDocumentos (NombreDocumento, FechaCreacion, UltimaModificacion, RutaArchivo, NumPags, Borrado) VALUES (?, NOW(), NOW(), ?, 1, 0)");
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $conn->error);
            }
    
            $stmt->bind_param("ss", $file_name, $target_file);
    
            if ($stmt->execute()) {
                echo "Subida exitosa a la base de datos.<br>";
    
                // Obtener el último ID insertado
                $ultimo_id = $conn->insert_id;
                echo "El ID insertado es: " . $ultimo_id;
            } else {
                echo "Error al insertar en la base de datos: " . $stmt->error;
            }
    
            $stmt->close();
            $conn->close();
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
    
?>