<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Exámenes propedéuticos</title>
    <link rel="preload" href="../CSSInicio/normalize.css" as="style">
    <link rel="stylesheet" href="../CSSInicio/normalize.css">
    <link href="CSSAdm/CSSAdm.css" rel="stylesheet">

</head>

<body>
    <header>
        <section>
            <h1>
                Captura de elementos mediante formulario
            </h1>
            <p>Comparación PDF</p>
        </section>

        
        <!-- Formulario para subir a la BD -->
        <form id='formularioSubida' method="post" enctype="multipart/form-data">
            <label for="PDF">PDF:</label>
            <input type="file" name="archivoPDF" id="PDF" accept="application/pdf" required />
            <button type="submit">Subir</button>
        </form>


    </header>
    <main>
        <!--Captura de datos mediante formulario -->
        <div class="ContenedorSeccion">
            <section>

                <br>

                <form >
                    <label for="Examen" class="Pill">Examen: </label>
                    <br><input type="radio" name="Examen" id="Examen" value="1" required /> Inicio
                    <br><input type="radio" name="Examen" id="Examen" value="2" required /> Final
                    <br>
                    <br>

                    <label for="Carrera">Carrera: </label>
                    <br><input type="radio" name="Carrera" id="Carrera" value="1" required /> I.C.
                    <br><input type="radio" name="Carrera" id="Carrera" value="2" required /> I.C.E.
                    <br><input type="radio" name="Carrera" id="Carrera" value="3" required /> I.M.
                    <br><input type="radio" name="Carrera" id="Carrera" value="4" required /> I.S.I.S.A.
                    <br>
                    <br>
                    <label>Escuela de procedencia: </label>
                    <input type="Text" required>
                    <br>
                    <br>
                    <p>Reactivos correctos: </p>
                    <label for="P1">Pregunta 1 </label>
                    <input type="checkbox" name="Reactivos" id="P1">
                    <br><label for="P2">Pregunta 2 </label>
                    <input type="checkbox" name="Reactivos" id="P2">
                    <br><label for="P3">Pregunta 3 </label>
                    <input type="checkbox" name="Reactivos" id="P3">
                    <br><label for="P4">Pregunta 4 </label>
                    <input type="checkbox" name="Reactivos" id="P4">
                    <br>
                    <br>
                    <label for="calificacion">Calificación </label>
                    <br><input type="number" name="Calificacion" id="calificacion" value="0" min="0" max="10" required>
                    <br><br>
                    <input type="submit" value="Ingresar datos" />
                </form>
            </section>
            <!--Captura de datos mediante formulario: se ingresa un PDF -->
            <section class="ContSecc2">
                <div id="mensajeResultado"></div>
                <h1>SeccionPDF</h1>

            </section>
        </div>
    </main>
    <footer>
        <section class="ContenedorFin">
            <a href='../index.php' class="Pill--selected"> Regresar </a>
    </footer>

    <script>
        document.getElementById('formularioSubida').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita que se recargue la página

            const form = e.target;
            const formData = new FormData(form);

            fetch('SubirArchivo.php', { 
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('mensajeResultado').innerHTML = data;
                    form.reset(); // Limpia el formulario si quieres
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('mensajeResultado').innerHTML = 'Hubo un error al subir el archivo.';
                });
        });
    </script>

</body>

</html>