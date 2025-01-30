<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Exámenes propedéuticos</title>
    <link rel="preload" href="CSS/normalize.css" as="style">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link href="CSSAdm/CSSAdm.css" rel="stylesheet"> 
</head>
<body>
    <header>
        <section>
            <h1> 
                Captura de elementos mediante formulario
            </h1>
            <p>Ingresa un bloque de elementos, máximo 30, haciendo una comparación con un PDF del mismo máximo de hojas.</p>
        </section>
        <!-- Formulario para subir a la BD -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="PDF">PDF</label>
        <input type="file" name="archivoPDF" accept="application/pdf" required />
        <button type="submit">Subir</button>
        </form>
        <!-- Script para subir el archivo -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivoPDF'])) 
        {
            $target_dir = "Uploads/"; //carpeta destino
            $file_name = basename($_FILES["archivoPDF"]["name"]);
            $target_file = $target_dir . $file_name;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            if ($file_type != "pdf") {
                echo "Solo se permiten archivos PDF.";
                exit;
            }
            if (move_uploaded_file($_FILES["archivoPDF"]["tmp_name"], $target_file)) {
                echo "El archivo se ha subido correctamente.";
                // Guardar en la base de datos (asumiendo una conexión previa)
                
                $conn = new mysqli('localhost', 'AdmnP', 'Revenant2159!', 'SistemaExamenes');
                $stmt = $conn->prepare("INSERT INTO controlDocumentos (NombreDocumento, FechaCreacion, UltimaModificacion, RutaArchivo, NumPags, Borrado) VALUES (?, NOW(), NOW(), $file_name, 1, 0)");
            
                $stmt->bind_param("ss", $file_name, $target_file);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                echo "Subida exitosa";
                
                $ultimo_id = $conn->insert_id;
                echo "El ID insertado es: " . $ultimo_id;
                
            } else {
                echo "Hubo un error al subir el archivo.";
            }
        }
        

        ?>

    </header>
    <main>
        <!--Captura de datos mediante formulario -->
        <div class="ContenedorSeccion">
        <section >
            
            <br>

            <form>
                <label for="Examen" class="Pill">Examen: </label>
                <br><input type="radio" name="Examen" id="Examen" value="1" required/> Inicio
                <br><input type="radio" name="Examen" id="Examen" value="2" required/> Final
                <br>
                <br>
                
                <label for="Carrera">Carrera: </label>
                <br><input type="radio" name="Carrera" id="Carrera" value="1" required/> I.C.
                <br><input type="radio" name="Carrera" id="Carrera" value="2" required/> I.C.E.
                <br><input type="radio" name="Carrera" id="Carrera" value="3" required/> I.M.
                <br><input type="radio" name="Carrera" id="Carrera" value="4" required/> I.S.I.S.A.
                <br>
                <br>
                <label>Escuela de procedencia: </label>
                <input type="Text" required>
                <br>
                <br>
                <p>Reactivos correctos: </p>
                <label for="P1">Pregunta 1 </label>
                <input type="checkbox" name="Reactivos" id="P1" >
                <br><label for="P2">Pregunta 2 </label>
                <input type="checkbox" name="Reactivos" id="P2" >
                <br><label for="P3">Pregunta 3 </label>
                <input type="checkbox" name="Reactivos" id="P3" >
                <br><label for="P4">Pregunta 4 </label>
                <input type="checkbox" name="Reactivos" id="P4" >
                <br>
                <br>
                <label for="calificacion">Calificación </label>
                <br><input type="number" name="Calificacion" id="calificacion" value="0" min="0" max="10" required>
                <br><br>
                <input type="submit" value="Ingresar datos"  />
            </form>
        </section>
        <!--Captura de datos mediante formulario: se ingresa un PDF -->
        <section class="ContSecc2">
            <h1>SeccionPDF</h1>
            <!-- Método: almacenamiento en BD, inicia más arriba -->
            

            <!--Médoto: Drive (pero puede ser otro servicio):  -->
            <!-- <iframe src="https://docs.google.com/file/d/1jIIsd4SlYtbazMSdpHz_CIf83RdXx59D/preview" width="700" height="600"></iframe>
            -->
        </section>
    </div>
    </main>
    <footer>
        <section class="ContenedorFin">
            <a href='../index.php' class="Pill--selected"> Regresar </a>
    </footer>
    
</body>
</html>